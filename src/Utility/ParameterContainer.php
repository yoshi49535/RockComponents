<?php
/************************************************************************************
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
 ************************************************************************************/
// <Namespace> 
namespace Rock\Components\Utility;

// <Use>

class ParameterContainer
  implements
    \ArrayAccess
{

	/**
	 *
	 */
	protected $params  = array();

	/**
	 *
	 */
	public function get($key)
	{
		return $this[$key];
	}

	/**
	 *
	 */
	public function offsetGet($idx)
	{
		return $this->params[$idx];
	}

	/**
	 *
	 */
	public function set($key, $value)
	{
		$this[$key] = $value;
	}

	/**
	 *
	 */
	public function offsetSet($idx, $value)
	{
		$this->params[$idx]  = $value;
	}

	/**
	 *
	 */
	public function has($key)
	{
		return isset($this[$key]);
	}

	/**
	 *
	 */
	public function offsetExists($idx)
	{
		return isset($this->params[$idx]);
	}

	/**
	 *
	 */
	public function remove($key)
	{
		unset($this[$key]);
	}

	/**
	 *
	 */
	public function offsetUnset($idx)
	{
		unset($this->params[$idx]);
	}

	/**
	 *
	 */
	public function getValues()
	{
		return $this->params;
	}
}

