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
namespace Rock\Component\Flow;

// <Use> : Flow Component
use Rock\Component\Flow\Traversal\ITraversalState;
use Rock\Component\Flow\Traversal\GraphTraversalState;
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Input\Input;
use Rock\Component\Flow\Output\GraphOutput;

// <Use> : Graph Component
use Rock\Component\Flow\Graph\FlowGraph as Graph;
use Rock\Component\Flow\IFlowComponent;
use Rock\Component\Flow\Graph\State\State;

// @use Exceptions
use Rock\Component\Flow\Exception\InitializeException;
use Rock\Component\Flow\Exception\TraversalStateException;
// @use Deleggate Interface
use Rock\Component\Flow\Delegate\IStateDelegate;

/**
 * Class GraphFlow is to use Graph Logic for Flow Implementation.
 * This class has the flow graph as flow structure.
 *
 */
class GraphFlow extends Flow
  implements
    \Countable
{
    /**
     * @var Rock\Component\Flow\Graph\IFlowGraph
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
	//public function dispatchState($traversal)
	//{
	//	$name  = $traversal->getName();

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
	protected function doHandleInput(ITraversalState $traversal)
	{
		try
		{
			$trail     = $traversal->getTrail();
			if(!$trail)
			{
			  throw new InitializeException('Failed to initialize Flow.');
			}
			$newTrail = null;

			// push next traversal into path
			if(count($trail) > 0)
			    $current = $trail->last()->current();
			else
				$current = null;

			if($current && $current->isEndPoint())
			{
				throw new \Exception('Flow already reached to EndPoint.');
			}

			//
			$graph   = $this->getPath();

			// Forward automaton traversal
			$newTrail = $graph->handle($traversal->getInput(), $current);
			$traversal->getOutput()->getTrail()->merge($newTrail);

			// 
			$this->doHandleState($traversal);

			// first component of trail is the current traversal, 
			// thus ignore
			$trail->merge($newTrail);
			$traversal->getOutput()->success();
		}
		catch(\Exception $ex)
		{
			$traversal->getOutput()->fail();
			throw $ex;
		}
	}

	/**
	 *
	 */
	protected function doHandleState(ITraversalState $traversal)
	{
		$trail  = $traversal->getOutput()->getTrail();
		if($trail && (count($trail) > 0))
		{
			try
			{
				$current = $trail->last()->current();
				if($current instanceof IFlowComponent)
					$current->handle($traversal->getInput());
			}
			catch(\Exception $ex)
			{
				throw $ex;
			}
		}
	}

	/**
	 *
	 */
	public function createTraversalState()
	{
		return new GraphTraversalState($this);
	}

	/**
	 *
	 */
	protected function createOutput()
	{
		return new GraphOutput($this->getPath()->createPath());
	}

	/**
	 *
	 */
	public function count()
	{
		return $this->getPath()->countVertices();
	}
	/**
	 *
	 */
	public function setStateDelegator($name, $delegator)
	{
		if(($delegator instanceof IStateDelegate) || is_callable($delegator))
		{
			$vertex = $this->getPath()->getVertexByName($name);
			if($vertex)
			{
				$vertex->setHandler($delegator);
			}
		}
		else
		{
			throw new \Exception('Delegator has to be an instanceof IStateDelegate, or callable.');
		}
	}
}
