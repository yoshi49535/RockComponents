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



/**
 *
 */
class ComponentBuilder
  implements
    IComponentBuilder
{
	protected $container;

	/** 
	 *
	 */
	public function __construct(IContainer $container)
	{
		$this->container  = $container;
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
	public function build($id)
	{
		// Get Container Definition for Target Component
		$container  = $this->getContainer();
		$definition = $container->getDefinition($id);

		// From Definition, get class and constructor arguments
		$class      = $definition->getClass();
		$arguments  = $definition->getArguments(); 

		// Reflection Class construct the instance w/ arugments
		$reference  = new \ReflectionClass($class);
		return $reference->newInstanceArgs($arguments);
	}
}
