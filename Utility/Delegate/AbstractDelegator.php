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
 * AbstractDelegator 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class AbstractDelegator
{
	
	/**
	 * invoker 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $invoker;

	/**
	 * __construct 
	 * 
	 * @param mixed $method 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * getInvoker 
	 * 
	 * @access public
	 * @return void
	 */
	public function getInvoker()
	{
		return $this->invoker;
	}

	/**
	 * __invoke 
	 * 
	 * @param mixed 
	 * @access public
	 * @return void
	 */
	public function createDelegate($method, $invoker = null)
	{
		return new Delegate(array($this, $method), $invoker);
	}
}
