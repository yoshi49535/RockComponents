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
namespace Rock\Components\Flow\Graph\State;

// <Base>
use Rock\Components\Automaton\State\NamedState;
// <Interface>
use Rock\Components\Flow\IFlowComponent;
// <Use>
use Rock\Components\Container\Graph\IGraph;
use Rock\Components\Flow\Graph\Graph as ExecutableGraph;
// <Use> : Automaton
use Rock\Components\Automaton\Input\IInput;
/**
 *
 */
class State extends NamedState
  implements 
    IFlowComponent
{
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
	 * Shortcut function for method-chain
	 */
	public function addNext($name, $listener = null, $condition = null)
	{
		$graph    = $this->getGraph();

		$class    = get_class($this);
		$newState = new $class($graph, $name, $listener);

		$graph->addState($newState);

		// Connect from THIS to NEW
		$graph->addCondition($this, $newState, $condition);

		return $newState;
	}

	public function handle(IInput $input)
	{
		if($this->listener)
			call_user_func($this->listener, $input);
	}

	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name=%s] on %s', get_class($this), $this->getName(), $this->getGraph());
	}
}
