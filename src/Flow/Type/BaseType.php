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
namespace Rock\Component\Flow\Type;
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;
// @use Definitions
use Rock\Component\Flow\Definition\FlowDefinition;
use Rock\Component\Flow\Definition\StateDefinition;
use Rock\Component\Flow\Definition\ConditionDefinition;
// @use Call
use Rock\Component\Configuration\Definition\Call;



/** 
 *
 */
abstract class BaseType extends FlowDefinition
{
	protected $defaultStateClass;
	protected $defaultConditionClass;
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);

		$this->defaultStateClass      = '\\Rock\\Component\\Flow\\Definition\\StateDefinition';
		$this->defaultConditionClass  = '\\Rock\\Component\\Flow\\Definition\\ConditionDefinition';
	}
	public function setContainer(IContainer $container)
	{
		parent::setContainer($container);

		// Configuration CompositeConfiguration
		$this->configure();
	}
	abstract protected function configure();

	// Shortcut Method-Chain Functions
	public function addState($name, $callback = null)
	{
		$class       = $this->defaultStateClass;
		$definition  = new $class($this->generateSubId($name));
		$definition->setAttribute('name', $name);
		
		if($callback)
			$definition->addCall(new Call('setHandler', array($callback)));
	
		$this->addStateDefinition($definition);
		return $this;
	}
	public function addCondition($callback)
	{
		$class      = $this->defaultConditionClass;
		$definition = new $class($this->getContainer()->generateUniqueId($this->getId()));
		$definition->addCall(new Call('setValidator', array($callback)));
		$this->addConditionDefinition($definition);
		return $this;
	}

	protected function generateSubId($id)
	{
		return sprintf('%s.%s',$this->getId(),$id);
	}
}
