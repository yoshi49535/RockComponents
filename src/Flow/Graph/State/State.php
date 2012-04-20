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

namespace Rock\Components\Flow\Graph\State;

// <BaseClass>
use Rock\Components\Automaton\State\NamedState;

// <Use>
use Rock\Components\Container\Graph\IGraph;
use Rock\Components\Flow\Graph\Graph as ExecutableGraph;

// <Use> : Automaton
use Rock\Components\Automaton\Input\IInput;
/**
 *
 */
class State extends NamedState
{
	/**
	 *
	 */
	public function __construct(IGraph $graph, $name, $listener = null)
	{
		parent::__construct($graph, $name);

		if(($graph instanceof ExecutableGraph) && $listener)
		{
			$this->getGraph()->addStateEvent($name, $listener);
		}
	}

	/**
	 * Shortcut function for method-chain
	 */
	public function addNext($name, $listener = null, $condition = null)
	{
		$graph    = $this->getGraph();
		$newState = new self($graph, $name, $listener);

		$graph->addState($newState);

		// Connect from THIS to NEW
		$graph->addCondition($this, $newState, $condition);

		return $newState;
	}

	public function handle(IInput $input)
	{
		$this->getGraph()->handleState($this, $input);
	}

	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name=%s] on %s', get_class($this), $this->getName(), $this->getGraph());
	}
}
