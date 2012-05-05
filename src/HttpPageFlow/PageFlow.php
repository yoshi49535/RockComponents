<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/

// <Namespace>
namespace Rock\Component\Http\Flow;

// <Base>
use Rock\Component\Flow\GraphFlow as BaseFlow;
// <use> : Flow Traversal
use Rock\Component\Flow\Traversal\ITraversalState;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Http\Flow\Input\IHttpInput;
use Rock\Component\Http\Flow\Output\Output;
// <Use> : Exception
use Rock\Component\Flow\Exception\TraversalStateException;
// <Use> : Flow Direction
use Rock\Component\Flow\Directions;

// <Use> : Flow Web-Page Component
use Rock\Component\Http\Flow\Session\ISession;
use Rock\Component\Http\Flow\Session\ISessionManager;
use Rock\Component\Http\Flow\Traversal\HttpPageTraversalState;

use Rock\Component\Container\Graph\Edge\IEdge;

class PageFlow extends BaseFlow
  implements 
    IHttpPageFlow
{
	/**
	 *
	 */
	protected $name;

	/**
	 *
	 */
	protected $sessions;

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		$this->initName();
	}

	/**
	 *
	 */
	protected function doRecoverTraversal(ITraversalState $traversal)
	{
		// Get graph trail from session 
		$trail = $traversal->getTrail();

		if(count($trail) === 0)
		{
			throw new TraversalStateException('Flow has never forwarded.');
		}

		// check the request traversal 
		if($traversal->getInput() instanceof IHttpInput)
		{
			$current = $trail->last()->current();
			if(!($request = $traversal->getInput()->getRequestState()) || ($request !== $current->getName()))
			{
				$traversal->reset();
			}
		}
	}

	/**
	 *
	 */
	protected function doShutdown(ITraversalState $traversal)
	{
		parent::doShutdown($traversal);
		
		if(!$traversal->isKeepAlive() && !$traversal->getOutput()->needRedirect())
		{
			// remove from session
			$this->getSessionManager()->remove($this->getHash());
		}

		// 
		if($traversal->getOutput()->isSuccess())
		{
			$this->getSessionManager()->save();
		}
	}

	/**
	 *
	 */
	protected function doHandleInput(ITraversalState $traversal)
	{
		try
		{
			$trail    = $traversal->getTrail();
			if(!$trail)
			{
				throw new InitializeException('Failed to initilize Flow.');
			}

			$newTrail = null;

			if($trail->count() === 0)
			{
				$traversal->getInput()->setDirection(Directions::NEXT);
			}
			//
			$direction = $traversal->getInput()->getDirection();
			if(Directions::NEXT === $direction)
			{
				do
				{
					parent::doHandleInput($traversal);
				}
				while($traversal->getOutput()->isSuccess() && !($traversal->getTrail()->last()->current() instanceof IPage));
			}
			else if(Directions::PREV === $direction)
			{
				// pop last state from path,
				// It is also release edges
				do
				{
					$trail->pop();
				}
				while(($trail->count() > 1) && !($trail->last()->current() instanceof IPage));
				// Keey going to current, cause PREV also show the page
			}

			if(Directions::NEXT !== $direction)
			{
				// Show current state page
				$current     = $traversal->getTrail()->last()->current();
				// Create Output
				$graph       = $this->getPath();
				$newTrail    = $graph->createPath();
				$newTrail->push($current);
				$traversal->getOutput()->setTrail($newTrail);

				$this->doHandleState($traversal);
			}
		}
		catch (\Exception $ex)
		{
			// lnitlaize Output
			$traversal->getOutput()->fail();
			throw $ex;
		}
	}

	/**
	 *
	 */
	public function createTraversalState()
	{
		return new HttpPageTraversalState($this, $this->getSessionManager()->get($this->getHash()));
	}

	/**
	 *
	 */
	public function setSessionManager(ISessionManager $manager)
	{
		$this->sessions = $manager;
	}

	/**
	 *
	 */
	public function getSessionManager()
	{
		if(!$this->sessions)
			throw new \Exception('Session Manager is not initialized.');
		return $this->sessions;
	}

	/**
	 *
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 *
	 */
	public function setName($name)
	{
		$this->name  = $name;
	}

	/**
	 *
	 */
	protected function initName()
	{
		$this->name  = strtolower(str_replace(get_class($this), '\\', '.'));
	}
	
	/**
	 *
	 */
	public function getHash()
	{
		return md5($this->getName());
	}

	/**
	 *
	 */
	protected function createOutput()
	{
		return new Output($this->getPath()->createPath());
	}
}
