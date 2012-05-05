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
namespace Rock\Component\Configuration\Definition;
// @extends

// 
use Rock\Component\Configuration\Definition\Filter\IFilter;

/**
 *
 */
class InjectionContainer extends Container
  implements 
    IFilterInjectionAware
{
	protected $filters  = array();

	/**
	 *
	 */
	public function addFilter(IFilter $filter)
	{
		$this->filters[$filter->getName()] = $filter;
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
