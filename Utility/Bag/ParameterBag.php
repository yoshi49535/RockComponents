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
	/**
	 * params 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $params  = array();

	/**
	 * __construct 
	 * 
	 * @param array|ParameterBag.. $values 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		// initialize 
		$this->params = array();

		foreach(func_get_args() as $arg)
		{
			if(is_array($arg))
				$this->merge($arg);
			else if($arg instanceof self)
				$this->merge($arg->all());
		}
	}
	/**
	 * get 
	 * 
	 * @param mixed $idx 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function get($idx, $default = null)
	{
		return array_key_exists($idx, $this->params) ? $this->params[$idx] : $default;
	}
	/**
	 * offsetGet 
	 * 
	 * @param mixed $index 
	 * @access public
	 * @return void
	 */
	public function offsetGet($index)
	{
		return $this->get($index);
	}

	/**
	 * set 
	 * 
	 * @param mixed $idx 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($idx, $value)
	{
		$this->params[$idx]  = $value;
	}
	/**
	 * offsetSet 
	 * 
	 * @param mixed $index 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function offsetSet($index, $value)
	{
		return $this->set($index, $value);
	}

	/**
	 * all 
	 * 
	 * @access public
	 * @return void
	 */
	public function all()
	{
		return $this->params;
	}
	
	/**
	 * merge 
	 * 
	 * @param mixed $values 
	 * @access public
	 * @return void
	 */
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
	 * replaceAll 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
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
	 * has 
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function has($idx)
	{
		return isset($this->params[$idx]);
	}
	/**
	 * offsetExists 
	 * 
	 * @param mixed $index 
	 * @access public
	 * @return void
	 */
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
	public function removeAll()
	{
		$this->params = array();
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

