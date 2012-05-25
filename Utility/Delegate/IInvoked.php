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
namespace Rock\Component\Utility\Delegate;

/**
 * IInvoked 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IInvoked
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
}
