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
// @interface
use Rock\Component\Configuration\Definition\IComponentBuilder;
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;
// @use Resolvers
use Rock\Component\Core\Resolver\CompositeResolver;
use Rock\Component\Configuration\Definition\Resolver\ParameterResolver;
use Rock\Component\Configuration\Definition\Resolver\ReferenceResolver;

/**
 *
 */
class ComponentBuilder
  implements
    IComponentBuilder
{
	/**
	 * @var IContainer
	 */
	protected $container;
	/**
	 * @var Resolver
	 */
	protected $resolver;

	/** 
	 *
	 */
	public function __construct()
	{
		$this->container  = null;
		$this->resolver   = null;	
	}

	public function setContainer(IContainer $container)
	{
		$this->container = $container;

		$this->initResolver();
	}
	/**
	 * 
	 * @return IContainer 
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 *
	 */
	protected function initResolver()
	{
		//
		$this->resolver  = new CompositeResolver(array(
			new ParameterResolver($this->container),
			new ReferenceResolver($this->container)
		));
	}
	/**
	 *
	 */
	public function build($id, $params = array())
	{
		// Get Container Definition for Target Component
		$container  = $this->getContainer();
		$definition = $container->getDefinition($id);

		// create ComponentDefinition
		$definition = $definition->instantiate($params);

		$instance   = $this->createInstanceFromDefinition($definition);

		if($container instanceof IFilterInjectionAware)
			$container->applyFilters($instance);

		$container->set($id, $instance);

		$container->enterScope($id);

		// Get Calls and call as initialization
		$calls   = $definition->getCalls();
		if($calls && is_array($calls))
		{
			foreach($calls as $call)
			{
				$args  = $call->getArguments();
				if($this->resolver)
				    $args  = $this->resolver->resolve($args);
				call_user_func_array(array($instance, $call->getMethod()), $args);
			}
		}
	
		$container->leaveScope();
		return $instance;
	}

	/**
	 * @param Definition The definition of the new instance
	 * @return mixin Created instance
	 */
	protected function createInstanceFromDefinition(Definition $definition)
	{
		// From Definition, get class and constructor arguments
		$class      = $definition->getClass();
		$arguments  = $definition->getArguments(); 

		// Resolve Pattern-Parameter and Reference
		if($this->resolver)
			$arguments = $this->resolver->resolve($arguments);

		// Reflection Class construct the instance w/ arugments
		$reference  = new \ReflectionClass($class);
		return $reference->newInstanceArgs($arguments);
	}
}
