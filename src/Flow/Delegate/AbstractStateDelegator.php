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
namespace Rock\Component\Flow\Delegate;

/**
 *
 */
class AbstractStateDelegator
  implements
    IStateDelegate
{
	/**
	 *
	 */
	protected $invoker = null;
	/**
	 * @return object Current Invoker
	 */
	public function getInvoker()
	{
		return $this->invoker;
	}
	/**
	 * @param object Set current Invoker
	 */
	protected function setInvoker($invoker)
	{
		$this->invoker  = $invoker;
	}
	/**
	 * Reset invoker as set null
	 */
	protected function resetInvoker()
	{
		$this->invoker  = null;
	}

	/**
	 * @param object Invoker object
	 * @return mixin Return value of extend codes
	 */
	public function delegate($invoker)
	{
		$args  = func_get_arg();
		// relace invoker
		$args  = array_shift($args);

		$this->setInvoker($invoker);

		$ret = call_user_func_array(array($this, 'doDelegate'), $args);

		$this->resetInvoker();

		return $ret;
	}

	/**
	 * @abstract
	 */
	abstract protected function doDelegate();
}
