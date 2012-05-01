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
	const SCOPE_SINGLETON  = '_singleton';
	const SCOPE_CURRENT    = '_current';
	/**
	 * @var
	 */
	protected $params = array();


	/**
	 * @var
	 */
	protected $scopes = array();
	/**
	 * @var 
	 */
	protected $aliases  = array();
	/**
	 * @var array of built components
	 */
	protected $components = array();

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

		$this->components = array();
		$this->enterScope(self::SCOPE_SINGLETON);
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
		if($definition instanceof IContainerAware)
			$definition->setContainer($this);
		//
		$this->definitions[$definition->getId()]  = $definition;

		if($definition->hasAttribute('alias'))
		{
			$this->aliases[$definition->getAttribute('alias')]  = $definition->getId();
		}
	}

	public function has($id)
	{
		return array_key_exists($id, $this->definitions);
	}
	/** 
	 *
	 */
	public function set($id, $value, $scope = self::SCOPE_CURRENT)
	{
		if($value instanceof Definition)
		{
			$this->addDefinition($value);
		}
		else
		{
			if(self::SCOPE_CURRENT === $scope)
				$scope  = $this->getScope();

			$this->components[$scope][$id]   = $value;
		}
	}

	public function getByAlias($alias)
	{
		if(!array_key_exists($alias, $this->aliases))
			throw new \Exception(sprintf('Alias "%s" is not defined.', $alias));
		//
		$id  = $this->aliases[$alias];

		return $this->get($id);
	}
	/**
	 *
	 */
	public function get($id)
	{
		// Check the scope components
		foreach($this->getScopes() as $scope)
		{
			if(array_key_exists($id, $this->components[$scope]))
				return $this->components[$scope][$id];
		}

		// 
		if(array_key_exists($id, $this->definitions))
		{
			// Build service from definition
			$builder  = $this->getComponentBuilder();
			$instance = $builder->build($id);
			if($instance instanceof IContainerAware)
			{
				$instance->setContainer($this);
			}
			
			// Regist component as a singleton
			if(($definition = $this->getDefinition($id)->hasAttribute('singleton')) && 
				$definition->getAttribute('singleton'))
			{
				$this->components[self::SCOPE_SINGLETON][$id] = $instance;
				//unset($this->definitions[$id]);
			}

			return $instance;
		}

		throw new \Exception(sprintf('Component "%s" is not defined.', $id));
	}


	protected function initComponentBuilder()
	{
		if(!$this->builder)
			$this->setComponentBuilder(new ComponentBuilder($this));
	}
	/**
	 * setComponentBuilder
	 */
	public function setComponentBuilder(ComponentBuilder $builder)
	{
		$builder->setContainer($this);
		$this->builder  = $builder;
	}
	/**
	 * Default Component Builder
	 */
	public function getComponentBuilder()
	{
		if(!$this->builder)
			$this->initComponentBuilder();
		return $this->builder;
	}

	/**
	 *
	 */
	public function enterScope($scope)
	{
		if(!is_string($scope))
		{
			throw new \InvalidArgumentException('$scope has to be a string.');
		}
		else if(in_array($scope, $this->scopes))
		{
			throw new \Exception(sprintf('Scope "%s" is already exists.', $scope));
		}
		$this->scopes[]  = $scope;
		$this->components[$scope] = array();
	}

	/**
	 *
	 */
	public function leaveScope()
	{
		$scope  = array_pop($this->scopes);

		// release all the components in the scope
		unset($this->components[$scope]);
	}

	public function getScopes()
	{
		return $this->scopes;
	}

	public function getScope()
	{
		return $this->scopes[count($this->scopes) - 1];
	}

	
	public function generateUniqueId($prefix = '')
	{

		$sCharList = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
		mt_srand();
		do{
			$id= '';
			for($i = 0; $i < 5; $i++)
				$id .= $sCharList[mt_rand(0, strlen($sCharList) - 1)];
		}while($this->has(($id = sprintf('%s%s', $prefix, $id))));

		return $id;
	}
}
