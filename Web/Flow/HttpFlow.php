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
namespace Rock\Component\Web\Flow;

// <Base>
use Rock\Component\Flow\Flow;
// <use> : Automaton Traversal
use Rock\Component\Automaton\Traversal\ITraversal;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Web\Flow\Input\IHttpInput;
// <Use> : Exception
use Rock\Component\Flow\Exception\TraversalStateException;
// <Use> : Flow Direction
use Rock\Component\Flow\Directions;

// <Use> : Flow Web-Page Component
use Rock\Component\Web\Session\ISession;
use Rock\Component\Web\Flow\Traversal\HttpTraversal;

// @use Web Page Interface
use Rock\Component\Web\Flow\Path\State\IPage;

/**
 * HttpFlow 
 * 
 * @uses BaseFlow
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class HttpFlow extends Flow
  implements 
    IHttpFlow
{
	/**
	 *
	 */
	protected $name;

	/**
	 *
	 */
	protected $session;

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
	protected function doRecoverTraversal(ITraversal $traversal)
	{
		// Get path trail from session 
		$trail = $traversal->getTrail();

		if(count($trail) === 0)
			throw new TraversalStateException('Flow has never forwarded.');

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
	 * doShutdown 
	 * 
	 * @param ITraversalState $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doShutdown(ITraversal $traversal)
	{
		parent::doShutdown($traversal);

		// 
		if($traversal->getOutput()->isSuccess())
		{
			$this->getSession()->save();
		}
		
		if(!$traversal->isKeepAlive() && !$traversal->getOutput()->needRedirect())
		{
			// remove from session
			$this->getSession()->delete();
		}
	}

	/**
	 *
	 */
	protected function doHandleInput(ITraversal $traversal)
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
			do
			{
				parent::doHandleInput($traversal);
			}
			while($traversal->getOutput()->isSuccess() && !($traversal->getTrail()->last()->current() instanceof IPage));
		}
		catch (\Exception $ex)
		{
			// lnitlaize Output
			$traversal->getOutput()->fail();
			throw $ex;
		}
	}

	/**
	 * createTraversal 
	 * 
	 * @access public
	 * @return void
	 */
	public function createTraversal()
	{
		return new HttpTraversal($this, $this->getSession());
	}

	public function setSession(ISession $session)
	{
		$this->session = $session;
	}
	public function getSession()
	{
		if(!$this->session)
			throw new \Exception('Session is not initialized');
		
		return $this->session;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name  = $name;
	}

	/**
	 * initName 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initName()
	{
		$this->name  = strtolower(str_replace(get_class($this), '\\', '.'));
	}
}
