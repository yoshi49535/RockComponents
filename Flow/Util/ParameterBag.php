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

// <Namespace> 
namespace Rock\Component\Flow\Util;
// <Interface>
use Rock\Component\Flow\Util\IParameterBag;

class ParameterBag 
  implements 
    IParameterBag
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

	/**
	 *
	 */
	public function set($idx, $value)
	{
		$this->params[$idx]  = $value;
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