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
namespace Rock\Component\Configuration\Container;
// @interface
use Rock\Component\Configuration\Container\IContainer;
// @use Definition and Provider
use Rock\Component\Configuration\Definition\Definition;
use Rock\Component\Configuration\Definition\Provider\IDefinitionProvider;
// @use Default Component Builder
use Rock\Component\Configuration\Builder\ComponentBuilder;
// @use
use Rock\Component\Utility\Bag\ParameterBag;

/**
 *
 */
class Container
  implements
    IContainer
{
	const SCOPE_COMPONENT_ROOT = '_component';

	const SCOPE_GLOBAL         = '_global';
	const SCOPE_CURRENT        = '_current';
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
		$this->definitions = array(self::SCOPE_GLOBAL => array());
		$this->params = new ParameterBag($params);

		$this->components = array();
		$this->enterScope(self::SCOPE_GLOBAL);
	}

	/**
	 *
	 */
	public function getDefinitions()
	{
		$definitions  = array();
		foreach($this->definitions as $scope => $defs)
		{
			$definitions = array_merge($definitions, $defs);
		}
		return $definitions;
	}

	/**
	 *
	 */
	public function getDefinition($id)
	{
		$definitions = $this->getDefinitions();
		return $definitions[$id];
	}

	public function addDefinitions($definitions, $scope = self::SCOPE_GLOBAL)
	{
		foreach($definitions as $definition)
			$this->addDefinition($definition, $scope);
	}
	/**
	 * addDefinition 
	 * 
	 * @param Definition $definition 
	 * @access public
	 * @return void
	 */
	public function addDefinition(Definition $definition, $scope = self::SCOPE_GLOBAL)
	{
		if($definition instanceof IContainerAware)
			$definition->setContainer($this);
		//

		if(self::SCOPE_CURRENT === $scope)
			$scope  = $this->getScope();
		$this->definitions[$scope][$definition->getId()]  = $definition;

		if($definition->hasAttribute('alias'))
		{
			$this->aliases[$definition->getAttribute('alias')]  = $definition->getId();
		}
	}


	/**
	 * has 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function has($id)
	{
		return array_key_exists($id, $this->getDefintiions());
	}

	/**
	 * set 
	 * 
	 * @param mixed $id 
	 * @param mixed $value 
	 * @param mixed $scope 
	 * @access public
	 * @return void
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

	/**
	 * getAliasId 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function getAliasId($alias)
	{
		if(!array_key_exists($alias, $this->aliases))
			throw new \Exception(sprintf('Alias "%s" is not defined.', $alias));
		//
		return $this->aliases[$alias];
	}
	/**
	 * getByAlias 
	 * 
	 * @param mixed $alias 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function getByAlias($alias, $params = array())
	{
		if(!array_key_exists($alias, $this->aliases))
			throw new \Exception(sprintf('Alias "%s" is not defined.', $alias));
		//
		$id  = $this->aliases[$alias];

		return $this->get($id, $params);
	}
	/**
	 *
	 */
	public function get($id, $params = array())
	{
		// Check the scope components
		foreach($this->getScopes() as $scope)
		{
			if(array_key_exists($id, $this->components[$scope]))
				return $this->components[$scope][$id];
		}

		// 
		if(array_key_exists($id, $this->getDefinitions()))
		{
			$bScoped  = false;

			$definition = $this->getDefinition($id);
			if(($this->countScopes() === 1) && !$definition->isSingleton())
			{
				$this->enterScope(self::SCOPE_COMPONENT_ROOT);
				$bScoped = true;
			}
			// Build service from definition
			$builder  = $this->getComponentBuilder();
			$instance = $builder->build($id);

			if($instance instanceof IContainerAware)
			{
				$instance->setContainer($this);
			}
			
			// Regist component as a singleton
			if($definition->isSingleton())
			{
				$this->components[self::SCOPE_GLOBAL][$id] = $instance;
				//unset($this->definitions[$id]);
			}

			if($bScoped)
			{
				$this->leaveScope();
				// Leave From SCOPE_COMPONENT_ROOT
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
	 * leaveScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function leaveScope()
	{
		$scope  = array_pop($this->scopes);

		// release all the components in the scope
		unset($this->components[$scope]);
	}

	/**
	 * countScopes 
	 * 
	 * @access public
	 * @return void
	 */
	public function countScopes()
	{
		return count($this->scopes);
	}
	/**
	 * getScopes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScopes()
	{
		return $this->scopes;
	}

	/**
	 * getScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScope()
	{
		return $this->scopes[count($this->scopes) - 1];
	}

	
	/**
	 * getParameterBag 
	 * 
	 * @access public
	 * @return void
	 */
	public function getParameterBag()
	{
		return $this->params;
	}
	/**
	 * getParameter 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getParameter($name)
	{
		if(!$this->params->has($name))
			throw new \Exception(sprintf('Parameter "%s" is not existed.', $name));
		return $this->params->get($name);;
	}
	/**
	 * setParameter 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setParameter($name, $value)
	{
		$this->params->set($name, $value);
	}

	/**
	 * generateUniqueId 
	 * 
	 * @param string $prefix 
	 * @access public
	 * @return void
	 */
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

	/**
	 * addProvider 
	 * 
	 * @param IDefinitionProvider $provider 
	 * @access public
	 * @return void
	 */
	public function addProvider(IDefinitionProvider $provider)
	{
		$this->addDefinitions($provider->getDefinitions());
	}
}
