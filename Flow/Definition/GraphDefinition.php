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
namespace Rock\Component\Flow\Definition;
// @extend
use Rock\Component\Configuration\Definition\ContainerAwareDefinition;
// @use Call
use Rock\Component\Configuration\Definition\Call;

/**
 *
 */
class GraphDefinition extends ContainerAwareDefinition
{
	
	/**
	 * components 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $components;

	/**
	 * __construct 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = '\\Rock\\Component\\Flow\\Graph\\FlowGraph';
	}
	//---
	// DefinePhase Functions
	public function addComponent(IFlowComponentDefinition $definition)
	{
		$this->components[]  = $definition;
		if($definition instanceof IFlowComponentDefinition)
		{
			$definition->setGraphDefinition($this);
		}

		// 
	}

	//---
	// CompilePhase
	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		parent::doConfigurateDefinition();
		foreach($this->components as $component)
			$this->registComponentCall($component);
	}

	/**
	 *
	 */
	protected function registComponentCall(IFlowComponentDefinition $definition)
	{
		$this->getContainer()->addDefinition($definition);
		if($definition instanceof StateDefinition)
		{
			$this->addCall(new Call(
				'addVertex',
				array($definition->getReference())
			));
		}
		else if($definition instanceof ConditionDefinition)
		{
			$this->addCall(new Call(
				'addEdge',
				array($definition->getReference())
			));
		}
	}
}
