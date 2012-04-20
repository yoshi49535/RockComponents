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
namespace Rock\Componets\Automaton\Condition;

// <Base>
use Rock\Componets\Container\Graph\Edge\Edge;
// <Interface>
use Rock\Componets\Automaton\Condition\ICondition;

// <Use> : Automaton Component
use Rock\Componets\Automaton\Input\IInput;
/**
 *
 */
class AnyCondition extends Edge
  implements
    ICondition
{
	public function isValid(IInput $cond = null)
	{
		return true;
	}
}
