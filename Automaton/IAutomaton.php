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
namespace Rock\Component\Automaton;
// @use
use Rock\Component\Automaton\Traversal\ITraversal;

/**
 *
 */
interface IAutomaton
{
	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	function getPath();

	/**
	 * backward 
	 * 
	 * @param ITraversal $traversal 
	 * @access public
	 * @return void
	 */
	function backward(ITraversal $traversal);
	
	/**
	 * forward 
	 * 
	 * @param ITraversal $traversal 
	 * @access public
	 * @return void
	 */
	function forward(ITraversal $traversal);


	/**
	 * createTraversal 
	 * 
	 * @access public
	 * @return void
	 */
	function createTraversal();
}
