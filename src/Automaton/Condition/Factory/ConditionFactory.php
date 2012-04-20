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
namespace Rock\Components\Automaton\Condition\Factory;

// <Interface>
use Rock\Components\Container\Graph\Edge\Factory\IEdgeFactory;

// <Use> : Graph Components
use Rock\Components\Container\Graph\Vertex\IVertex;

// <Use> : Automaton Components
use Rock\Components\Automaton\State\IState;

// <Use> : Automaton Conditions as Graph Edge
use Rock\Components\Automaton\Condition\AnyCondition;
use Rock\Components\Automaton\Condition\Condition;

/**
 *
 */
class ConditionFactory
  implements
    IEdgeFactory
{
	public function createEdge(IVertex $source, IVertex $target)
	{
		return $this->createCondition($source, $target);
	}
	public function createCondition(IState $source, IState $target, $validator = null)
	{
		if(!$validator)
			return new AnyCondition($source, $target);
		else
			return new Condition($source, $target, $validator);
	}
}
