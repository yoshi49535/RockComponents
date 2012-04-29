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
namespace Rock\Component\Configuration\Defintion\Reference;
// @use 
use Rock\Component\Configuration\Definition\IContainer;

/**
 *
 */
class Reference
{
	/** 
	 * @var IContainer Container instance where the reference target is contained.
	 */
	protected $container;
	/** 
	 * @var string Id of the reference target
	 */
	protected $id;
	/** 
	 * @var string Scope of where the referenced instance is created
	 */
	protected $scope;

	/** 
	 *
	 */
	public function __construct(IContainer $container, $id)
	{
		$this->container  = $container;
		$this->id         = $id;

		// Initialize scope w/ current container scope
		$this->scope      = $this->container->getScope();
	}

	/**
	 * @return mixin The reference target instance
	 */
	public function get()
	{
		return $this->container->get($this->id, $this->scope);
	}
}
