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

namespace Rock\Component\Automaton\Condition\Factory;

// <Interface>
use Rock\Component\Container\Graph\Edge\Factory\IEdgeFactory;

// <Use> : Graph Component
use Rock\Component\Container\Graph\Vertex\IVertex;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;

// <Use> : Automaton Conditions as Graph Edge
use Rock\Component\Automaton\Condition\Condition;

/**
 *
 */
class ConditionFactory
  implements
    IEdgeFactory
{
	/**
	 *
	 */
	public function createEdge(IVertex $source, IVertex $target)
	{
		return $this->createCondition($source, $target);
	}
	/**
	 *
	 */
	public function createCondition(IState $source, IState $target)
	{
		return new Condition($source, $target);
	}
}
