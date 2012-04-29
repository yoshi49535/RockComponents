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
namespace Rock\Component\Flow\Graph\State;

// <Base>
use Rock\Component\Automaton\State\NamedState;
// <Interface>
use Rock\Component\Flow\IFlowComponent;
// <Use> : Graph
use Rock\Component\Container\Graph\IGraph;
//use Rock\Component\Flow\Graph\Graph as ExecutableGraph;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
/**
 *
 */
class State extends NamedState
  implements 
    IFlowComponent
{
	/**
	 * @var
	 */
	protected $listener;

	/**
	 *
	 */
	public function __construct(IGraph $graph, $name, $listener = null)
	{
		parent::__construct($graph, $name);
		
		if($listener && !is_callable($listener))
		{
			throw new \InvalidArgumentException('Listener has to be a callable or null.');
		}
		$this->listener  = $listener;
	}

	/**
	 *
	 */
	public function getFlow()
	{
		if(!($graph  = $this->getGraph()) instanceof IFlowPath)
			throw new \Exception('IFlowComponent holder has to be an IFlowPath');
		return $graph->getFlow();
	}
	/**
	 * Shortcut function for method-chain
	 */
	public function addNext($name, $listener = null)
	{
		$graph    = $this->getGraph();

		$class    = get_class($this);
		$newState = new $class($graph, $name, $listener);

		$graph->addVertex($newState);

		// Connect from THIS to NEW
		$graph->addEdge($this, $newState);

		return $newState;
	}

	
	/**
	 *
	 */
	public function addPreValidator($callable)
	{
		// Get the 
		$graph  = $this->getGraph();
		//
		$edges  = $graph->getEdgesTo($this);
		
		// Insert Callable Validator 
		if($edges && is_array($edges))
			foreach($edges as $edge)
				$edge->setValidator($callable);
		return $this;
	}

	/**
	 *
	 */
	public function addPostValidator($callable)
	{
		// Get the 
		$graph  = $this->getGraph();
		//
		$edges  = $graph->getEdgesFrom($this);
		
		// Insert Callable Validator 
		if($edges && is_array($edges))
			foreach($edges as $edge)
				$edge->setValidator($callable);

		return $this;
	}

	/**
	 *
	 */
	public function end()
	{
		$this->isEndPoint(true);
	}

	/**
	 *
	 */
	public function handle(IInput $input)
	{
		if($this->listener)
			call_user_func($this->listener, $input);
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name=%s] on %s', get_class($this), $this->getName(), $this->getGraph());
	}

}
