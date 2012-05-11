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

namespace Rock\Component\Automaton\Condition;

// <Base>
use Rock\Component\Container\Graph\Edge\Edge;
// <Interface>
use Rock\Component\Automaton\Condition\ICondition;

// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;
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
