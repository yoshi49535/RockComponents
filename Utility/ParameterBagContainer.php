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

	/**
	 * __construct 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function __construct($params = array())
	{
		$this->params  = new ParameterBag($params);
	}

	/**
	 * getParameterBag 
	 * 
	 * @access public
	 * @return void
	 */
	public function getParameterBag()
	{
		return $this->params;
	}

	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function get($name)
	{
		return $this->params[$name];
	}

	/**
	 * set 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($name, $value)
	{
		$this->params[$name] = $value;
	}

	/**
	 * has 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function has($name)
	{
		return isset($this->params[$name]);
	}

	/**
	 * all 
	 * 
	 * @access public
	 * @return void
	 */
	public function all()
	{
		return $this->params->all();
	}
}
