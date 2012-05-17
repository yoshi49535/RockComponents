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

/**
 * Node 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Node
{
	/**
	 * state 
	 *	Create new Node as State
	 * @access public
	 * @return void
	 */
	public function state()
	{

		$state = new Node();

		return $state;
	}

	public function page()
	{

	}

	public function setDelegate()
	{
	}

	public function validate()
	{
	}
	/**
	 * end 
	 * 
	 * @access public
	 * @return void
	 */
	public function end()
	{
		$this->end = true;
	}
}
