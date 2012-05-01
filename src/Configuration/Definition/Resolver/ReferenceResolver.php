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
namespace Rock\Component\Configuration\Definition\Resolver;
// @interface
use Rock\Component\Core\Resolver\IResolver;
// @use Container
use Rock\Component\Configuration\Definition\IContainer;
// @use Reference
use Rock\Component\Configuration\Definition\Reference;

/**
 *
 */
class ReferenceResolver
  implements
    IResolver
{
	/**
	 *
	 */
	protected $container;
	
	/**
	 *
	 */
	public function __construct(IContainer $container)
	{
		$this->container = $container;
	}

	/**
	 *
	 */
	public function resolve($value)
	{
		if($value instanceof Reference)
			$value = $this->container->get($value->getId());

		return $value;
	}
}

