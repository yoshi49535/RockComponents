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
namespace Rock\Components\Flow;

// <Use> : Flow Components
use Rock\Components\Flow\State\IFlowState;
use Rock\Components\Flow\State\GraphFlowState;
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\Input\Input;
use Rock\Components\Flow\Output\GraphOutput;

// <Use> : Graph Components
use Rock\Components\Flow\Graph\FlowGraph as Graph;
use Rock\Components\Flow\Graph\State\State;

// <Use> : Exceptions
use Rock\Components\Flow\Exception\InitializeException;
use Rock\Components\Flow\Exception\FlowStateException;

/**
 * Class GraphFlow is to use Graph Logic for Flow Implementation.
 * This class has the flow graph as flow structure.
 *
 */
class GraphFlow extends Flow
{
    /**
     * @var Rock\Components\Flow\Graph\IFlowGraph
     */
	protected $path;

	/**
	 * 
	 */
	protected function doInitPath()
	{
		// Initialize Graph Graph
		$this->path = new Graph($this);
	}

	///**
	// */
	//public function dispatchState($state)
	//{
	//	$name  = $state->getName();

	//	$event = $this->dispatcher->top();
	//	if($event instanceof IFlowEvent)
	//	{
	//		$this->dispatch(FlowEvents::flat($name), $event);
	//	}
	//	// Merge Output w/ Base Dispatch
	//	//$this->dispatcher->last();
	//}
	/**
	 *
	 */
	protected function doHandleInput(IFlowState $state)
	{
		$trail     = $state->getTrail();
		if(!$trail)
		{
		  throw new InitializeException('Failed to initialize Flow.');
		}
		$newTrail = null;

		// push next state into path

		if(count($trail) > 0)
		    $current = $trail->last()->current();
		else
			$current = null;

		if($current && $current->isEndPoint())
		{
			throw new \Exception('Flow already reached to EndPoint.');
		}



		$graph   = $this->getPath();

		// Forward automaton state
		$newTrail = $graph->handle($state->getInput(), $current);
		$state->getOutput()->setTrail($newTrail);

		// first component of trail is the current state, thus ignore
		$trails = $newTrail->getTrail();
		if($trails)
		{
			foreach($trails as $component)
			{
				$trail->push($component);
			}
		}
	}


	/**
	 *
	 */
	public function createFlowState()
	{
		return new GraphFlowState($this);
	}

	/*
	 *
	 */
	public function setEntryPoint($name, $listener = null)
	{
		// Path As Graph
		$graph   = $this->getPath();
		if($graph->hasRoot())
		{
			throw new \Exception('EntryPoint already exists.');
		}

		$vertex  = new State($graph, $name, $listener);
		$vertex->isEntryPoint(true);
		$graph->addState($vertex);

		return $vertex;
	}

	/**
	 *
	 */
	protected function createOutput()
	{
		return new GraphOutput();
	}
}
