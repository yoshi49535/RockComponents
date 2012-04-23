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
namespace Rock\Components\Automaton;

// <BaseClass>
use Rock\Components\Container\Graph\DirectedGraph;
// <Interface>
use Rock\Components\Automaton\IAutomaton;

// <Use> : Graph Component
use Rock\Components\Container\Graph\Vertex\IVertex;
use Rock\Components\Container\Graph\Path\Path;

// <Use> : Automaton Components
use Rock\Components\Automaton\State\IState;
use Rock\Components\Automaton\Condition\Factory\ConditionFactory;
use Rock\Components\Automaton\Input\IInput;

/**
 *
 */
class Automaton extends DirectedGraph
  implements
    IAutomaton
{
	
	/**
	 *
	 */
	public function addVertex(IVertex $vertex)
	{
		throw new \Exception('Use "addState" instead of "addVertex".');
	}
	/**
	 *
	 */
	public function addState(IState $state)
	{
		return parent::addVertex($state);
	}

	/**
	 *
	 */
	public function addEdge(IVertex $source, IVertex $target)
	{
		throw new \Exception('Use "addCondtion" instead of "addEdge".');
	}
	/**
	 *
	 */
	public function addCondition(IState $source, IState $target, $condition = null)
	{
		$this->edges[]  = ($edge = $this->getEdgeFactory()->createCondition($source, $target, $condition));

		return $edge;
	}
	/**
	 *
	 */
	public function root()
	{
		$vertices  = $this->getVertices();

		foreach($vertices as $vertex)
		{
			if($vertex->isEntryPoint())
			{
				return $vertex;
			}
		}
		throw new \Exception('Entry Point is not defined.');
	}

	/**
	 *
	 */
	public function hasRoot()
	{
		$hasRoot   = false;
		$vertices  = $this->getVertices();

		foreach($vertices as $vertex)
		{
			if($vertex->isEntryPoint())
			{
				$hasRoot  = true;
				break;
			}
		}
		return $hasRoot;
	}
	/**
	 *
	 */
	protected function initEdgeFactory()
	{
		$this->edgeFactory = new ConditionFactory();
	}

	/**
	 *
	 */
	public function createPath()
	{
		return new Path($this);
	}

	public function backward(IPath $path)
	{
		//
		return $path;
	}
	/**
	 * forward
	 *   Evaluate the input and if possible forward the state.
	 * 
	 */
	public function forward(IInput $input = null, IState $begin = null)
	{
		$path  = $this->createPath();
	
		// Grab edges which sourced from current state pos
		if(!$begin)
		{
			$path->push($this->root());
		}
		else
		{
			foreach($this->getEdgesFrom($begin) as $edge)
			{
				if($edge->isValid($input))
				{
					// Push the path
					//$path->push($edge->getSource());
					$path->push($edge);
					$path->push($edge->getTarget());

					break;
				}
			}
		}

		return $path;
	}

}
