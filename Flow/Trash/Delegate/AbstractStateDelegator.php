<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/
// @namespace
namespace Rock\Component\Flow\Delegate;
// @use ParameterBag
use Rock\Component\Flow\Util\ParameterBag;

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
	 *
	 */
	protected $method;

	protected $params;
	/**
	 *
	 */
	public function __construct()
	{
		$this->invoker = null;
		$this->method  = 'doDelegate';
		$this->params  = new ParameterBag();
	}
	
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
	 *
	 */
	public function setDelegateMethod($method)
	{
		if(!method_exists($this, $method))
		{
			throw new \Exception(sprintf('Delegate Method "%s" is not exists.', $method));
		}

		$this->method  = $method;
	}

	/**
	 *
	 */
	public function getDelegateMethod()
	{
		return $this->method;
	}

	/**
	 *
	 */
	public function getParameterBag()
	{
		return $this->params;
	}
	public function getParameters()
	{
		return $this->params->all();
	}

	/**
	 *
	 */
	public function setParameters($params)
	{
		$this->params->replaceAll($params);
	}

	/**
	 * delegate 
	 * 
	 * @param mixed $invoker Invoker Instance 
	 * @access public
	 * @return mixed Return value of Extend Code
	 */
	public function delegate($invoker)
	{
		$args  = func_get_args();
		// relace invoker
		array_shift($args);

		$this->setInvoker($invoker);

		$ret = call_user_func_array(array($this, $this->getDelegateMethod()), $args);

		$this->resetInvoker();

		return $ret;
	}

	/**
	 * __invoker 
	 * 
	 * @access public
	 * @return void
	 */
	public function __invoker()
	{
		//
		return $this->delegate();
	}
}