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
// @namespace
namespace Rock\Component\Flow;
// @extends 
use Rock\Component\Automaton\IAutomaton;
// @use 
use Rock\Component\Flow\IO\IInput;
use Rock\Component\Automaton\Traversal\ITraversal;

/**
 * IFlow 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IFlow extends IAutomaton
{
	const UNIQUE_BY_NAME   = 'name';
	const UNIQUE_BY_SEQ_ID = 'id';


	/**
	 * initWithAttributes 
	 * 
	 * @param array $attributes 
	 * @access public
	 * @return void
	 */
	function initWithAttributes(array $attributes = array());

	/**
	 * handle 
	 *   From Input, detect the direction of execute automaton, and 
	 *   execute it. Return Output of Automaton
	 * @param IInput $request 
	 * @param ITraversal $state 
	 * @access public
	 * @return void
	 */
	function handle(IInput $request, ITraversal $state = null);
}
