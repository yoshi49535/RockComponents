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
namespace Rock\Component\Utility\Delegate;

/**
 * IDelegator 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IDelegator
{
	/**
	 * getInvoker 
	 * 
	 * @access public
	 * @return void
	 */
	function getInvoker();

	/**
	 * setInvoker 
	 * 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	function setInvoker($invoker);

	/**
	 * resetInvoker 
	 * 
	 * @access public
	 * @return void
	 */
	function resetInvoker();
}
