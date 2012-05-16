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
namespace Rock\Component\Utility;
// @use Parameter Bag
use Rock\Component\Utility\Bag\ParameterBag;

class ParameterBagContainer
{
	protected $params;

	public function __construct($params = array())
	{
		$this->params  = new ParameterBag($params);
	}

	public function getParameterBag()
	{
		return $this->params;
	}

	public function get($name)
	{
		return $this->params[$name];
	}

	public function set($name, $value)
	{
		$this->params[$name] = $value;
	}

	public function has($name)
	{
		return isset($this->params[$name]);
	}

	public function all()
	{
		return $this->params->all();
	}
}
