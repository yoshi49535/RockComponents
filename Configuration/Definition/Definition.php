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
use Rock\Component\Configuration\Component\Reference;
use Rock\Component\Configuration\Component\Call;
// @use Scopes 
use Rock\Component\Configuration\Container\Container;

/**
 * Definition 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
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
	public function __construct($id, array $attributes = array())
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


	/**
	 * setCalls 
	 * 
	 * @param mixed $calls 
	 * @access public
	 * @return void
	 */
	public function setCalls($calls)
	{
		$this->calls    = $calls;
	}
	/**
	 * addCall 
	 * 
	 * @param Call $call 
	 * @access public
	 * @return void
	 */
	public function addCall(Call $call)
	{
		$this->calls[]  = $call;
	}

	/**
	 * getCall 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
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

	/**
	 * getCalls 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCalls()
	{
		return $this->calls;
	}

	/**
	 * removeCall 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
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
	 * getClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * setClass 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setClass($class)
	{
		$this->class  = $class;
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return $this->getAttribute('alias');
	}

	/**
	 * setAlias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function setAlias($alias)
	{
		$this->setAttribute('alias', $alias);
	}
	/**
	 * setArguments 
	 * 
	 * @param array $arguments 
	 * @access public
	 * @return void
	 */
	public function setArguments(array $arguments)
	{
		$this->arguments  = $arguments;
	}
	/**
	 * getArguments 
	 * 
	 * @access public
	 * @return void
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 * addArgument 
	 * 
	 * @param mixed $argument 
	 * @access public
	 * @return void
	 */
	public function addArgument($argument)
	{
		$this->arguments[] = $argument;
	}

	/**
	 * getReference 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReference()
	{
		return new Reference($this->getId());
	}

	/**
	 * isSingleton 
	 *   Bool iff the uniqueOn is located at GLOBAL
	 * @access public
	 * @return void
	 */
	public function isSingleton()
	{
		return $this->hasAttribute('uniqueOn') && ($this->getAttribute('uniqueOn') === Container::SCOPE_GLOBAL);
	}


	/**
	 * getScope 
	 *   Scope is the container-scope where the definition is activated-at
	 * @access public
	 * @return void
	 */
	public function getScope()
	{
		return isset($this->attributes['scope']) ?
		  $this->attributes['scope'] :
		  Container::SCOPE_GLOBAL
		;
	}

	/**
	 * getUniqueOn 
	 *   UniqueOn is the container-scope where the component instance allocated at. 
	 * @access public
	 * @return void
	 */
	public function getUniqueOn()
	{
		return isset($this->attributes['uniqueOn']) ?
			$this->attributes['uniqueOn'] :
			(isset($this->attribute['scope']) ? 
				$this->attributes['scope'] :
				Container::SCOPE_PROTOTYPE
			)
		;
	}
}
