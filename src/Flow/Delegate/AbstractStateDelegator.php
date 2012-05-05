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
	protected $invoker = null;
	public function getInvoker()
	{
		return $this->invoker;
	}
	protected function setInvoker($invoker)
	{
		$this->invoker  = $invoker;
	}
	protected function resetInvoker()
	{
		$this->invoker  = null;
	}


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

	abstract protected function doDelegate();
}
