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
namespace Rock\Component\Configuration\Definition\Filter;
// @interface
use Rock\Component\Configuration\Definition\Filter\IFilter;

abstract class AbstractFilter
  implements
    IFilter
{
	protected $name;

	/**
	 *
	 */
	public function __construct($name)
	{
		$this->name  = $name;
	}
	/**
	 *
	 */
	public function getName()
	{
		return $this->name;
	}
}
