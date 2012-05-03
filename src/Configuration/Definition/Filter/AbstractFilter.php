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
