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
// @use
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
	
	protected $configured;
	/**
	 *
	 */
	public function __construct($id, $attributes = array())
	{
		$this->id          = $id;
		$this->attributes  = $attributes;
		$this->arguments   = array();
		$this->configured  = false;

		if(array_key_exists('class', $attributes))
			$this->class = $attributes['class'];
	}

	/**
	 * @final
	 * @param void
	 * @return void
	 */
	final public function configurateDefinition()
	{
		if(!$this->configured)
		{
			$this->doConfigurateDefinition();
			$this->configured = true;
		}
	}

	protected function doConfigurateDefinition()
	{
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


	public function setCalls($calls)
	{
		$this->calls    = $calls;
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
		return new Reference($this->getId());
	}

	public function isSingleton()
	{
		return $this->hasAttribute('singleton') && (bool)$this->getAttribute('singleton');
	}

	public function instantiate($params = array())
	{
		if(!$params)
		{
			$params  = $this->getAttributes();
		}
		else if(is_array($params))
		{
			$params  = array_merge($this->getAttributes(), $params);
		}

		// Before initialize ComponentDefinition, initializeDefinition
		$this->configurateDefinition();

		$definition  = new ComponentDefinition($this->getId(), $params, $this);

		// 
		$definition->setClass($this->getClass());
		$definition->setArguments($this->getArguments());
		//
		$definition->setCalls($this->getCalls());

		return $definition;
	}

}
