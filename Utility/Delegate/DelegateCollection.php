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
 * DelegateCollection 
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class DelegateCollection
  implements
    IDelegatorProvider,
	IInvoked
{
	
	/**
	 * invoker 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $invoker;
	
	/**
	 * createDelegator 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function createDelegator(array $params = array())
	{
		if(isset($params['method']))
			return new MethodDelegator($this, $params['method']);

		return new InvokeDelegator($this);
	}

	/**
	 * setInvoker 
	 * 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	public function setInvoker($invoker)
	{
		$this->invoker = $invoker;
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
}
