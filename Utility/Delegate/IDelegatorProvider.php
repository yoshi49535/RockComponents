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
 * IDelegateProvider 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IDelegatorProvider
{
	/**
	 * createDelegator 
	 *   Create new Delegator. 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	function createDelegator(array $params = array());
}
