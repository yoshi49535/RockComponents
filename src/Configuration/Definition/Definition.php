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

use Rock\Component\Configuration\Definition\Reference;

/**
 *
 */
class Definition
{
	/** 
	 * @var
	 */
	protected $id;
	/** 
	 * @var
	 */
	protected $class;
	/** 
	 * @var
	 */
	protected $attributes = array();
	/** 
	 * @var
	 */
	protected $arguments = array();
	/** 
	 * @var
	 */
	protected $calls = array();
	
	/**
	 *
	 */
	public function __construct($id, $attributes = array())
	{
		$this->id          = $id;
		$this->attributes  = $attributes;
		$this->arguments   = array();
	}

	/**
	 *
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 *
	 */
	public function hasAttribute($key)
	{
		return array_key_exists($key, $this->attributes);
	}
	/**
	 *
	 */
	public function setAttribute($name, $value)
	{
		// 
		$this->attributes[$name] = $value;
	}

	/**
	 *
	 */
	public function getAttribute($name)
	{
		return $this->attributes[$name];
	}
	/**
	 *
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}
	/**
	 *
	 */
	public function replaceAttributes(array $attrs = array())
	{
		$this->attributes  = $attrs;
	}

	/**
	 *
	 */
	public function addCall(Call $call)
	{
		$this->calls[]  = $call;
	}

	/**
	 *
	 */
	public function getCall($method)
	{
		foreach($this->calls as $call)
		{
			if($call->isMethod($method))
			{
				return $call;
			}
		}
	}

	public function getCalls()
	{
		return $this->calls;
	}

	/**
	 *
	 */
	public function removeCall($method)
	{
		foreach($this->calls as $key => $call)
		{
			if($call->isMethod($method))
				unset($this->calls[$key]);
		}
	}

	/**
	 *
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 *
	 */
	public function setClass($class)
	{
		$this->class  = $class;
	}

	/**
	 *
	 */
	public function getAlias()
	{
		return $this->getAttribute('alias');
	}

	/**
	 *
	 */
	public function setAlias($alias)
	{
		$this->setAttribute('alias', $alias);
	}

	/**
	 *
	 */
	public function setArguments(array $arguments)
	{
		$this->arguments  = $arguments;
	}
	/**
	 *
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 *
	 */
	public function addArgument($argument)
	{
		$this->arguments[] = $argument;
	}

	public function getReference()
	{
		return new Reference($this->id);
	}

	public function isSingleton()
	{
		return $this->hasAttribute('singleton') && (bool)$this->getAttribute('singleton');
	}

}
