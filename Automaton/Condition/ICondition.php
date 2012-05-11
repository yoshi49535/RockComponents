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

// <Namespace>
namespace Rock\Component\Automaton\Condition;

// <Base>
use Rock\Component\Container\Graph\Edge\IEdge;
// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;

interface ICondition extends IEdge
{
	/**
	 *
	 */
	public function isValid(IInput $cond = null);
}
