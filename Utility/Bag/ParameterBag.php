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
namespace Rock\Component\Utility\Bag;
// @interface
use Rock\Component\Utility\Bag\IParameterBag;

/**
 * ParameterBag 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ParameterBag 
  implements 
    IParameterBag,
	\ArrayAccess
{
	protected $params  = array();

	public function __construct($values = array())
	{
		if(is_array($values))
			$this->params = $values;
		else if($values instanceof self)
			$this->params = $values->all();
	}
	/**
	 *
	 */
	public function get($idx, $default = null)
	{
		return array_key_exists($idx, $this->params) ? $this->params[$idx] : $default;
	}
	public function offsetGet($index)
	{
		return $this->get($index);
	}

	/**
	 *
	 */
	public function set($idx, $value)
	{
		$this->params[$idx]  = $value;
	}
	public function offsetSet($index, $value)
	{
		return $this->set($index, $value);
	}

	/**
	 *
	 */
	public function all()
	{
		return $this->params;
	}
	
	public function merge($values)
	{
		if($values instanceof self)
		{
			$this->params = array_merge($this->params, $values->all());
		}
		else if(is_array($values))
		{
			$this->params = array_merge($this->params, $values);
		}
	}
	/**
	 *
	 */
	public function replaceAll($params = array())
	{
		if(is_object($params) && ($params instanceof IParameterBag))
		{
			$this->params  = $params->all();
		}
		else if(is_array($params))
		{
			$this->params  = $params;
		}
	}

	/**
	 *
	 */
	public function has($idx)
	{
		return isset($this->params[$idx]);
	}
	public function offsetExists($index)
	{
		return $this->has($index);
	}

	public function remove($idx)
	{
		if(array_key_exists($idx, $this->params))
			unset($this->params[$idx]);
	}
	public function offsetUnset($index)
	{
		return $this->remove($index);
	}
	/**
	 *
	 */
	public function __toString()
	{
		return sprintf(
			"ParameterBag[%s] : keys[%s] vlaues[%s]", 
			get_class($this),
			implode(',', array_keys($this->params)),
			implode(',', $this->params)
		);
	}
}

