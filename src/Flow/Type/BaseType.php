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

	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		//
		parent::doConfigurateDefinition();

		// Configurate Graph Path Template
		$this->configure();
	}
	abstract protected function configure();
	
	// Shortcut Method-Chain Functions
	/**
	 *
	 */
	public function addState($name, $callback = null)
	{
		$class       = $this->defaultStateClass;
		$definition  = new $class($this->generateSubId($name));
		$definition->setAttribute('name', $name);
		$definition->setAttribute('handler', $callback);
		
		$this->addStateDefinition($definition);
		return $this;
	}

	/**
	 *
	 */
	public function addCondition($callback)
	{
		$class      = $this->defaultConditionClass;
		$definition = new $class($this->getContainer()->generateUniqueId($this->getId()));

		$definition->setAttribute('validator', $callback);
		$this->addConditionDefinition($definition);
		return $this;
	}

	/**
	 *
	 */
	protected function generateSubId($id)
	{
		return sprintf('%s.%s',$this->getId(),$id);
	}
}
