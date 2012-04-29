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
namespace Rock\Component\Flow\Definition;
// @use
use Rock\Component\Configuration\Definition\Definition;

/**
 *
 */
class FlowDefinition extends Definition
{
	/**
	 * @var
	 */
	protected $subs;


	/**
	 * @var
	 */
	protected $components = array();

	/**
	 *
	 */
	public function __construct($id, $components = array(), $attributes = array())
	{
		parent::__construct($id, $attributes);

		// initialize parameters
		$this->class      = '\\Rock\\Component\\Flow\\GraphFlow';
		$this->arguments  = array();
		$this->components = is_array($components) ? $components : array();
		$this->subs       = array();
	}

	/**
	 *
	 */
	public function addComponentDefinition($id, IFlowComponentDefinition $component)
	{
		$this->container->set($id, $this->components[$id] = $component);
	}

	/**
	 *
	 */
	public function getComponentDefinitions()
	{
		return $this->components;
	}

	/**
	 *
	 */
	public function getComponentDefinition($id)
	{
		return $this->components[$id];
	}

	// 
	public function addStateDefinition($id, IStateDefinition $state)
	{
		if(count($this->components) > 0)
		{
			if(($last = $this->getLastInsertedComponentDefinition()) instanceof IConditionDefinition)
			{
				$last->setTarget(new Reference($this->contaienr, $state));
			}
			else if($last instanceof IStateDefinition)
			{
				// Create new
				$cond = new ConditionDefinition();
				$cond->setSource(new Reference($this->container, $last));
				$cond->setTarget(new Reference($this->container, $state));
				$this->addComponentDefinition($cond);
			}
		}

		// Add Component
		$this->addComponentDefinition($id, $state);
	}
	/**
	 *
	 */
	public function addConditionDefinition(ICondtionDefinition $cond)
	{
		if(count($this->components) > 0)
		{
			$cond->setSource(new Reference($this, $id));
			$this->addComponentDefinition($id, $cond);
		}

	}

	// Sub Flow Definition
	// Fixme: Not Implemented Yet
	/**
	 *
	 */
	public function getSubFlowDefinitions()
	{
		throw new NotImplementedException();
	}

	/**
	 *
	 */
	public function validate()
	{
	}
}
