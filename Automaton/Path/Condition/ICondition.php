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
namespace Rock\Component\Automaton\Path\Condition;
// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;

/**
 * ICondition 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ICondition
{
	/**
	 *
	 */
	function isValid(IInput $cond = null);

	/**
	 * getSource 
	 * 
	 * @access public
	 * @return void
	 */
	function getSource();

	/**
	 * getTarget 
	 * 
	 * @access public
	 * @return void
	 */
	function getTarget();
}
