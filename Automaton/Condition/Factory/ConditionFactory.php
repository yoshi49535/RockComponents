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
namespace Rock\Componets\Automaton\Condition\Factory;

// <Interface>
use Rock\Componets\Container\Graph\Edge\Factory\IEdgeFactory;

// <Use> : Graph Components
use Rock\Componets\Container\Graph\Vertex\IVertex;

// <Use> : Automaton Components
use Rock\Componets\Automaton\State\IState;

// <Use> : Automaton Conditions as Graph Edge
use Rock\Componets\Automaton\Condition\AnyCondition;
use Rock\Componets\Automaton\Condition\Condition;

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
