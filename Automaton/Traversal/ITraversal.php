<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
// @namespace
namespace Rock\Component\Automaton\Traversal;
// @use
use Rock\Component\Automaton\IO\IInput;

interface ITraversal
{
	/**
	 * getInput 
	 * 
	 * @access public
	 * @return void
	 */
	function getInput();

	/**
	 * setInput 
	 * 
	 * @param IInput $input 
	 * @access public
	 * @return void
	 */
	function setInput(IInput $input);

	/**
	 * hasInput 
	 * 
	 * @access public
	 * @return void
	 */
	function hasInput();

	/**
	 * getOutput 
	 * 
	 * @access public
	 * @return void
	 */
	function getOutput();

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	function reset();
}
