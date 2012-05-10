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
// @extends
use Rock\Component\Configuration\Definition\ContainerAwareDefinition;
// @use Call
use Rock\Component\Configuration\Definition\Call;

use Rock\Component\Configuration\Definition\Reference as Reference;

/**
 *
 */
class FlowDefinition extends ContainerAwareDefinition
{
	/**
	 * @var
	 */
	protected $subs;

	/**
	 * @var
	 */
	protected $last;

	/**
	 *
	 */
	protected $graph;
	/**
	 *
	 */
	public function __construct($id, $attributes = array())
	{
		parent::__construct($id, $attributes);

		// initialize parameters
		$this->class      = '\\Rock\\Component\\Flow\\GraphFlow';
		$this->arguments  = array();
		$this->subs       = array();
		$this->graph      = null;
	}

	/**
	 *
	 */
	public function getGraphDefinition()
	{
		if(!$this->graph)
		{
			// Create and Regist Graph Definition for GraphFlow
			$definition = new GraphDefinition($this->getId().'.graph');
			$definition->addArgument($this->getReference());
			$this->getContainer()->addDefinition($definition);
			// 
			$this->graph  = $definition;
		}

		return $this->graph;
	}

	// ----
	// Component Regist Functions for GraphDefinition 
	/**
	 * addComponentDefinition 
	 * 
	 * @param IFlowComponentDefinition $component 
	 * @access public
	 * @return void
	 */
	public function addComponentDefinition(IFlowComponentDefinition $component)
	{
		$this->getGraphDefinition()->addComponent($component);
		//$component->setGraph($this->getGraphDefinition());

		$this->last  = $component;
	}

	// 
	/**
	 * addStateDefinition 
	 * 
	 * @param StateDefinition $definition 
	 * @access public
	 * @return void
	 */
	public function addStateDefinition(StateDefinition $definition)
	{
		{
			if(($last = $this->last) instanceof ConditionDefinition)
			{
				$last->setTarget($definition->getReference());
			}
			else if($last instanceof StateDefinition)
			{
				// Create new
				$cond = new ConditionDefinition();
				$cond->setSource($last->getReference());
				$cond->setTarget($definition->getReference());
				$this->addComponentDefinition($cond);
			}
		}

		// Add Component
		$this->addComponentDefinition($definition);
	}

	/**
	 *
	 */
	public function addConditionDefinition(ConditionDefinition $definition)
	{
		if($this->last instanceof StateDefinition)
		{
			$definition->setSource($this->last->getReference());
			$this->addComponentDefinition($definition);
		}
		else
		{
			throw new \Exception('Condition cannot add after condition.');
		}
	}
	//----
	// Compile Phase Functionalities
	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		//
		$this->addCall(new Call('setPath', array($this->getGraphDefinition()->getReference())));
	}
	//----
}
