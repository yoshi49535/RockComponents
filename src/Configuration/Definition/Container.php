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
namespace Rock\Component\Configuration\Definition;
// @interface
use Rock\Component\Configuration\Definition\IContainer;
// @use Definition 
use Rock\Component\Configuration\Definition\Definition;
// @use Default Component Builder
use Rock\Component\Configuration\Definition\ComponentBuilder;

/**
 *
 */
class Container
  implements
    IContainer
{
	/**
	 * @var
	 */
	protected $params = array();

	/**
	 * @var
	 */
	protected $singletons = array();

	/**
	 * @var
	 */
	protected $definitions = array();

	/**
	 * @var
	 */
	protected $builder;

	/**
	 *
	 */
	public function __construct($params = array())
	{
		$this->definitions = array();
		$this->params = is_null($params) ? new ParameterBag() : $params;
	}

	/**
	 *
	 */
	public function getDefinitions()
	{
		return $this->definitions;
	}

	/**
	 *
	 */
	public function getDefinition($id)
	{
		return $this->definitions[$id];
	}
	/**
	 *
	 */
	public function addDefinition(Definition $definition)
	{
		$this->definitions[$definition->getId()]  = $definition;
	}

	/** 
	 *
	 */
	public function set($id, $value)
	{
		if($value instanceof Definition)
		{
			$this->definitions[$id]  = $value;
		}
		else
		{
			$this->singleton[$id]  = $value;
		}
	}
	/**
	 *
	 */
	public function get($id)
	{
		if(array_key_exists($id, $this->singletons))
		{
			return $this->singletons[$id];
		}

		// 
		if(array_key_exists($id, $this->definitions))
		{
			// Build service from definition
			$builder = $this->getComponentBuilder();
			$instance = $builder->build($id);

			if($this->getDefinition($id)->getAttribute('singleton'))
			{
				$this->singletons[$id] = $instance;
				unset($this->definitions[$id]);
			}
			
			return $instance;
		}

		throw new \Exception(sprintf('Component "%s" is not defined.', $id));
	}


	/**
	 * Default Component Builder
	 */
	public function getComponentBuilder()
	{
		if(!$this->builder)
			$this->builder  = new ComponentBuilder($this);
		return $this->builder;
	}
}
