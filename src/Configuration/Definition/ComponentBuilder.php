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
	public function build($id)
	{
		// Get Container Definition for Target Component
		$container  = $this->getContainer();
		$definition = $container->getDefinition($id);
		

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
