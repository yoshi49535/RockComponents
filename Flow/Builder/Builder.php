<?php
/************************************************************************************
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/

namespace Rock\Components\Flow\Builder;


// <Interface>

// <Use>
use Rock\Components\Configuration\IFlowConfiguration;
use Rock\Components\Flow\Factory\IFactory as IFlowFactory;

/**
 * Flow Builder.
 */
class Builder 
  implements
	IFlowBuilder
{
	/**
	 *
	 */
	protected $factory;

	/**
	 *
	 */
	protected $flow;

	/**
	 *
	 */
	public function __construct(IFlowFactory $factory)
	{

		$this->factory  = $factory;
	}
	/**
	 *
	 */
	public function getFactory()
	{
		return $this->factory;
	}
	/**
	 * getFlowClass
	 */
	public function getFlowClass()
	{
		return $this->flowClass;
	}
	public function setFlowClass($classname)
	{
		$this->flowClass = $classname;
	}
	/**
	 *
	 */
	public function applyConfiguration(IFlowConfiguration $configuration)
	{
		// Apply Configuration Values
		$this->setFlowClass($configuration->getFlowClass());
	}
	/**
	 *
	 */
	public function build($rebuild = false)
	{
		if(!$this->flow || $rebuild)
		{
		    // try to compare, if it is recovered 
		    $flow = $this->getFactory()->create($this->getFlowClass());

		    // Execute for request
		    //$flow->handle($request);
		    $this->flow   = $flow;
		}
		return $this->flow;
	}
}
