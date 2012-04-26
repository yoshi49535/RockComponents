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
// <Namespace> 
namespace Rock\Components\Flow\Util;
// <Interface>
use Rock\Components\Flow\Util\IParameterBag;

class ParameterBag 
  implements 
    IParameterBag
{
	protected $params  = array();
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
