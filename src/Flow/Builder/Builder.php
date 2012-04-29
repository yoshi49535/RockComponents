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
// <Namespace>
namespace Rock\Component\Flow\Builder;
// <Interface>
use Rock\Component\Flow\Builder\IFlowBuilder;
// <Use>
use Rock\Component\Flow\Configuration\IConfiguration;
use Rock\Component\Flow\Factory\IFactory as IFlowFactory;
// @use : Flow Definition
use Rock\Component\Flow\Definition\FlowDefinition;

/**
 * Flow Builder.
 */
class Builder 
  implements
	IFlowBuilder
{
	/**
	 * @var
	 */
	protected $factory;

	/**
	 *
	 */
	public function __construct(IFlowFactory $factory, IFlowDefinition $definition = null)
	{
		$this->factory    = $factory;
		$this->definition = is_null($definition) ? new FlowDefinition() : $definition;
	}
	/**
	 *
	 */
	public function getFactory()
	{
		return $this->factory;
	}

	public function buildState(IStateDefinition $definition)
	{
		// Create Page Instance from Definition
		$class = $definition->getClass();
		$state = new $class($component->getName(), $component->getListener());

		if(!$state instanceof IState)
		{
			throw new \Exception(sprintf('Flow State Definition includes invalid class  "%s", but IState is needed.', $class));
		}

		return $page;
	}
	
	/**
	 * @param ConditionDefinition $definition
	 */
	public function buildCondition(IConditionDefinition $definition)
	{
		
	}

	/**
	 * @param string $id
	 * @return Flow
	 */
	public function build($id)
	{
		// Get Root Flow Definition
		$definition = $this->getDefinition();

		$components  = $definition->getChildren();
		$path 	= $flow->getPath();
		//
		foreach($definition->getStateDefinitions() as $component)
		{
			// 
			$state  = $this->buildState($component);
			// Set Additional Attribute
			if($path->countStates())
				$state->isEntryPoint(true);

			$path->addState($state);
		}

		// Create Connections
		{

		}

		// try to compare, if it is recovered 
		$flow = $this->getFactory()->create($name);

		return $flow;
	}
}
