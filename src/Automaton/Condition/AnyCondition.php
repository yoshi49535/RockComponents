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
namespace Rock\Components\Automaton\Condition;

// <Base>
use Rock\Components\Container\Graph\Edge\Edge;
// <Interface>
use Rock\Components\Automaton\Condition\ICondition;

// <Use> : Automaton Component
use Rock\Components\Automaton\Input\IInput;
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
