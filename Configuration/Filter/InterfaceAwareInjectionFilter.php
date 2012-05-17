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
namespace Rock\Component\Configuration\Filter;
// @interface
use Rock\Component\Configuration\Filter\IFilter;

/**
 *
 */
class InterfaceAwareInjectionFilter extends AbstractFilter
  implements
    IFilter
{
	protected $interface;
	protected $method;
	protected $cleanedInject;
	protected $inject;
	protected $resolver;

	/**
	 *
	 */
	public function __construct($name, $interface, $method, $inject)
	{
		parent::__construct($name);
		$this->interface  = $interface;
		$this->method     = $method;
		$this->inject     = $inject;
	}

	/**
	 *
	 */
	public function apply($instance)
	{
		$interface = $this->getInterface();
		if($instance instanceof $interface)
			$this->doApply($instance);
	}
	/**
	 *
	 */
	protected function doApply($instance)
	{
		call_user_func_array(array($instance, $this->getInjectionMethod()), array($this->getInjection()));
	}
	/**
	 *
	 */
	public function getInjectionMethod()
	{
		if(!$this->method || !is_string($this->method))
			throw new \Exception('Injection Method is not initiaized, or not string.');
		return $this->method;
	}
	/**
	 *
	 */
	public function getInjection()
	{
		if(!$this->cleanedInject)
			$this->cleanInject();
		return $this->cleanedInject;
	}

	public function cleanInject()
	{
		if($this->resolver)
			$this->cleanedInject  = $this->resolver->resolve($this->inject);
		else
			$this->cleanedInject  = $this->inject;
	}

	/**
	 *
	 */
	public function getInterface()
	{
		if(!is_string($this->interface))
			throw new \Exception('Interface has to be an string.');
		//else if(!class_exists($this->interface))
		//	throw new \Exception(sprintf('Interface "%s" is not exists.', $this->interface));

		return $this->interface;
	}

	public function setResolver($resolver)
	{
		$this->resolver  = $resolver;
	}


}
