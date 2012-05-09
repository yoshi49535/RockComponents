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
use Rock\Component\Configuration\Definition\Definition;
// @interface
use Rock\Component\Configuration\Definition\IContainerAware;
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;
// @use Call
use Rock\Component\Configuration\Definition\Call;

use Rock\Component\Configuration\Definition\Reference as Reference;

/**
 *
 */
class FlowDefinition extends Definition
  implements 
    IContainerAware
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
	protected $container;
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
	public function addComponentDefinition(IFlowComponentDefinition $component)
	{
		if(($container = $this->getContainer()) && ($component instanceof Definition))
			$container->addDefinition($component);

		$this->getGraphDefinition()->addChild($component);
		//$component->setGraph($this->getGraphDefinition());

		$this->last  = $component;
	}

	// 
	/**
	 *
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
				$cond = new ConditionDefinition($this->getContainer()->generateUniqueId($this->getId().'.edge.'));
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

	// Sub Flow Definition
	// Fixme: Not Implemented Yet
	/**
	 *
	 */
	public function addFlowDefinion(FlowDefinition $definition)
	{
	}
	/**
	 *
	 */
	public function getFlowDefinitions()
	{
		throw new NotImplementedException();
	}

	/**
	 *
	 */
	public function validate()
	{
	}

	protected function doConfigurateDefinition()
	{
		$this->addCall(new Call('setPath', array($this->getGraphDefinition()->getReference())));
	}
	/**
	 *
	 */
	public function getGraphDefinition()
	{
		if(!$this->graph)
		{
			$definition = new GraphDefinition($this->getId().'.graph');
			$definition->addArgument($this->getReference());
			
			//$this->addCall(new Call('setPath', array($definition->getReference())));

			// Regist into container
			$this->getContainer()->addDefinition($definition);
		
			$this->graph  = $definition;
		}

		return $this->graph;
	}
	/**
	 *
	 */
	public function getContainer()
	{
		if(!$this->container)
		{
			throw new \Exception('Container is not initialized.');
		}
		return $this->container;
	}
	/**
	 *
	 */
	public function setContainer(IContainer $container)
	{
		$this->container = $container;
	}
}
