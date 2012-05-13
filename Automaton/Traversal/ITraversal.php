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
	 * getOutput 
	 * 
	 * @access public
	 * @return void
	 */
	function getOutput();
}
