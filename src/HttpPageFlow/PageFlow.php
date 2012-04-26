<?php
/************************************************************************************
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/
// <Namespace>
namespace Rock\Components\Http\Flow;

// <Base>
use Rock\Components\Flow\GraphFlow as BaseFlow;
// <use> : Flow State
use Rock\Components\Flow\State\IFlowState;
// <Use> : Flow IO
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Http\Flow\Input\IHttpInput;
use Rock\Components\Http\Flow\Output\Output;
// <Use> : Exception
use Rock\Components\Flow\Exception\FlowStateException;
// <Use> : Flow Direction
use Rock\Components\Flow\Directions;

// <Use> : Flow Web-Page Components
use Rock\Components\Http\Flow\Session\ISession;
use Rock\Components\Http\Flow\Session\ISessionManager;
use Rock\Components\Http\Flow\State\PageFlowState;

use Rock\Components\Container\Graph\Edge\IEdge;

class PageFlow extends BaseFlow
{
	/**
	 *
	 */
	protected $name;

	/**
	 *
	 */
	protected $sessions;

	public function __construct()
	{
		parent::__construct();

		$this->initName();
	}
	/**
	 *
	 */
	protected function doRecoverState(IFlowState $state)
	{
		// Get graph trail from session 
		$trail = $state->getTrail();

		if(count($trail->getComponents()) == 0)
		{
			throw new FlowStateException('Flow has never forwarded.');
		}

		// check the request state 
		if($state->getInput() instanceof IHttpInput)
		{
			$current = $trail->last()->current();
			if(!($request = $state->getInput()->getRequestState()) || ($request !== $current->getName()))
			{
				$state->reset();
			}
		}
	}

	/**
	 *
	 */
	protected function doShutdown(IFlowState $state)
	{
		parent::doShutdown($state);
		
		if(!$state->isKeepAlive() && !$state->getOutput()->useRedirection())
		{
			// remove from session
			$this->getSessionManager()->remove($this->getHash());
		}
		$this->getSessionManager()->save();
	}
	/**
	 *
	 */
	protected function doHandleInput(IFlowState $state)
	{
		$trail    = $state->getTrail();
		if(!$trail)
		{
			throw new InitializeException('Failed to initilize Flow.');
		}

		$newTrail = null;

		if($trail->count() === 0)
		{
			$state->getInput()->setDirection(Directions::NEXT);
		}
		//
		switch($state->getInput()->getDirection())
		{
		case Directions::NEXT:
			parent::doHandleInput($state);
			break;
		case Directions::PREV:
			// pop last state from path,
			// It is also release edges
			$trail->pop();
			while($trail && $trail->last()->current() instanceof IEdge)
			{
				$trail->pop();
			}
			// Keey going to current, cause PREV also show the page
		case Directions::CURRENT:
		default:
			// Show current state page
			$current     = $state->getTrail()->last()->current();
			// Create Output
			$graph       = $this->getPath();
			$newTrail    = $graph->createPath();
			$newTrail->push($current);
			$state->getOutput()->setTrail($newTrail);

			$this->doHandleState($state);
			break;
		}
	}

	protected function doHandleState(IFlowState $state)
	{
		if(!$state->getOutput()->useRedirection())
		{
			parent::doHandleState($state);
		}
	}

	/**
	 *
	 */
	public function createFlowState()
	{
		return new PageFlowState($this, $this->getSessionManager()->get($this->getHash()));
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
	protected function createPage($name, $listener)
	{
		$page  = new Page($this->getPath(), $name, $listener);
		$this->getPath()->addState($page);

		return $page;
	}
	/**
	 *
	 */
	public function setEntryPage($name, $listener = null)
	{
		if($this->getPath()->hasRoot())
		{
			throw new \Exception('EntryPoint already exists.');
		}
		$page   = $this->createPage($name, $listener);
		$page->isEntryPoint(true);

		return $page;
	}

	/**
	 * 
	 */
	public function setEntryPoint($name, $listener = null)
	{
		return $this->setEntryPage($name, $listener);
	}
	/**
	 *
	 */
	protected function createOutput()
	{
		return new Output();
	}
}
