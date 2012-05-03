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
namespace Rock\Component\Automaton;

// <BaseClass>
use Rock\Component\Container\Graph\DirectedGraph;
// <Interface>
use Rock\Component\Automaton\IAutomaton;

// <Use> : Graph Component
use Rock\Component\Container\Graph\Vertex\IVertex;
use Rock\Component\Automaton\Trail\Trail;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Automaton\Condition\Factory\ConditionFactory;
use Rock\Component\Automaton\Input\IInput;
// <Use> : Exception
use Rock\Component\Automaton\Exception\InvalidConditionException;

/**
 *
 */
class Automaton extends DirectedGraph
  implements
    IAutomaton
{
	protected $debug;

	/**
	 * @override
	 */
	public function __construct()
	{
		parent::__construct();

		$this->debug  = true;
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
		return new Trail($this);
	}

	/**
	 *
	 */
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
			$path->push($begin);
			foreach($this->getEdgesFrom($begin) as $edge)
			{
				if($edge->isValid($input))
				{
					// Push the path
					$path->push($edge);
					$path->push($edge->getTarget());
					break;
				}
			}
		}
		return $path;
	}

	/**
	 *
	 */
	public function isHandleException()
	{
		return $this->debug;
	}
	/**
	 *
	 */
	public function useHandleException($debug)
	{
		$this->debug = $debug;
	}

	public function addVertex(IVertex $vertex)
	{
		if($this->countVertices() === 0)
		{
			$vertex->isEntryPoint(true);
		}
		parent::addVertex($vertex);
	}
}
