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
// @use Container
use Rock\Component\Configuration\Definition\Container;
// @use Call
use Rock\Component\Configuration\Definition\Call;
// @use 
use Rock\Component\Configuration\Definition\Reference as Reference;
// @use
use Rock\Component\Configuration\Definition\DelegateDefinition;

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

	public function getDelegateName($name, $prefix = '')
	{
        return $prefix.ucfirst(preg_replace('/[_\.](\w)/ie', 'ucfirst(\\1)', strtolower($name)));
	}


	/**
	 * createDelegateDefinition 
	 *  Create DelegateDefinition to point Flow Delegator 
	 * @param mixed $delegateMethod 
	 * @access public
	 * @return void
	 */
	public function createDelegateDefinition($delegateMethod)
	{
		// Delegate to FlowDelegate
		$definition  = new DelegateDefinition($this->getId().'.delegate.'.$delegateMethod.'.onFlow');

		// 
		$definition->addArgument(array($this->getReference(), 'callDelegate'));
		$definition->addArgument($this->getReference());


		// Regitst 
		$this->getContainer()->addDefinition($definition, Container::SCOPE_CURRENT);

		
		// Add delegates into flow
		$this->addCall(new Call('setDelegate', array($delegateMethod, $definition->getReference())));

		//
		return $definition;
	}

	/**
	 * setDefaultDelegate 
	 * 
	 * @param mixed $methodName 
	 * @param mixed $callback 
	 * @access public
	 * @return void
	 */
	public function setDefaultDelegate($methodName, $callback)
	{
		// Delegate to FlowDelegate
		$definition  = new DelegateDefinition($this->getId().'.delegate.'.$methodName.'.default');

		$definition->addArgument($callback);
		$definition->addArgument($this->getReference());

		// Regitst 
		$this->getContainer()->addDefinition($definition, Container::SCOPE_CURRENT);

		//
		$this->addCall(
			new Call(
				'setDelegate',
				array(
					$methodName,
					$definition->getReference()
				)
			)
		);
	}
}
