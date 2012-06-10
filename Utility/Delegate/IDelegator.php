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
	 * __invoke 
	 * 
	 * @access protected
	 * @return void
	 */
	function __invoke();

	/**
	 * delegate 
	 * 
	 * @param array $args 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	function delegate(array $args = array(), $invoker = null);

	/**
	 * merge
	 *  Return new CompositeDelegator which merge this and other. 
	 *  This Delegator always before another.
	 *
	 * @param IDelegator $other 
	 * @access public
	 * @return void
	 */
	function merge(IDelegator $other);
}
