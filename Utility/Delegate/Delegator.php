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
//
namespace Rock\Component\Utility\Delegate;
//
use Rock\Component\Utility\Delegate\IInvoked;

/**
 * Delegator 
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class Delegator
  implements
    IDelegator
{

	/**
	 * getCallable 
	 * 
	 * @abstract
	 * @access protected
	 * @return mixed
	 */
	abstract protected function getCallback();

	/**
	 * getMethodOwner 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function getMethodOwner();

	/**
	 * delegate 
	 * 
	 * @param array $args 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	public function delegate(array $args = array(), $invoker = null)
	{
		$owner    = $this->getMethodOwner();
		if($owner instanceof IInvoked)
		{
			$orgInvoker = $owner->getInvoker();
			$owner->setInvoker($invoker);
		}
		$callback = $this->getCallback();

		$ret = call_user_func_array($callback, $args);


		if($owner instanceof IInvoked)
		{
			$owner->setInvoker($orgInvoker);
		}
		return $ret;
	}
	/**
	 * __invoke 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __invoke()
	{
		$args     = func_get_args();

		return $this->delegate($args);
	}
}

