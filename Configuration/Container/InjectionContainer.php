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
namespace Rock\Component\Configuration\Container;
// @extends

// @interface
use Rock\Component\Configuration\Aware\IFilterInjectionAware;
// 
use Rock\Component\Configuration\Filter\IFilter;
use Rock\Component\Configuration\Filter\InterfaceAwareInjectionFilter;

/**
 *
 */
class InjectionContainer extends Container
  implements 
    IFilterInjectionAware
{
	protected $filters  = array();

	/**
	 * init 
	 *   Init Container 
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
		parent::init();

		// add Default Filter of IContainer Aware
		$this->addFilter(new InterfaceAwareInjectionFilter(
			'_interface.aware.container',
			'\\Rock\\Component\\Configuration\\Aware\\IContainerAwareI',
			'setContainer',
			$this
		)); 
	}
	/**
	 *
	 */
	public function addFilter(IFilter $filter)
	{
		$this->filters[$filter->getName()] = $filter;
		$filter->setResolver($this->getComponentBuilder()->getResolver());
	}

	/**
	 *
	 */
	public function removeFilter($name)
	{
		if(array_key_exists($name, $this->filters))
			unset($this->filters[$name]);
	}

	/**
	 *
	 */
	public function getFilters()
	{
		return $this->filters;
	}

	/**
	 *
	 */
	public function applyFilters($instance)
	{
		foreach($this->filters as $filter)
		{
			$filter->apply($instance);
		}
	}
}
