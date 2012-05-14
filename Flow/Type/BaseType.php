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

		$this->defaultStateClass      = '\\Rock\\Component\\Flow\\Definition\\Graph\\Component\\StateDefinition';
		$this->defaultConditionClass  = '\\Rock\\Component\\Flow\\Definition\\Graph\\Component\\ConditionDefinition';
	}

	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		// Configuration 
		$this->configure();

		//
		parent::doConfigurateDefinition();
	}
	/**
	 * configure 
	 *  Configuration of the Path.
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function configure();
	
	// Shortcut Method-Chain Functions
	/**
	 * addState 
	 * Add StateDefinition into Definition
	 * 
	 * @param mixed $name 
	 * @param mixed $callback 
	 * @access public
	 * @return void
	 */
	public function addState($name, $defaultCallback = null, array $params = array())
	{
		// merge parameters
		$params = array_merge(
			// Defaults
			array(
				'class' => $this->defaultStateClass,
				'attributes' => array(),
				'delegate_prefix' => 'doState'
			), 
			$params);
		
		//
		$delegateMethod = $this->getDelegateName($name, $params['delegate_prefix']);
		if($defaultCallback)
			$this->setDefaultDelegate($delegateMethod, $defaultCallback);
		$delegate       = $this->createDelegateDefinition($delegateMethod);

		// merge attributes
		$attrs  = array_merge(
			$params['attributes'],
			array(
				'name'    => $name,
				'handler' => $delegate
			));
		
		// 
		$class       = $params['class'];
		$definition  = new $class($this->generateSubId($name), $attrs);

		$this->addStateDefinition($definition);
		return $this;
	}

	/**
	 *
	 */
	public function addCondition($name, $defaultCallback, array $params = array())
	{
		// merge parameters
		$params = array_merge(
			// Defaults
			array(
				'class' => $this->defaultConditionClass,
				'attributes' => array(),
				'delegate_prefix' => 'doCondition'
			), 
			$params);
		
		//
		$delegateMethod = $this->getDelegateName($name, $params['delegate_prefix']);
		if($defaultCallback)
			$this->setDefaultDelegate($delegateMethod, $defaultCallback);
		$delegate       = $this->createDelegateDefinition($delegateMethod);
		
		// merge attributes
		$attrs  = array_merge(
			$params['attributes'],
			array(
				'name'      => $name,
				'validator' => $delegate->getReference()
			));
	
		// regist validator as Default Delegator of FlowDelegate 
		// And get FlowDelegate

		// Create definition 
		$class      = $params['class'];
		$definition = new $class($attrs);

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

	public function __toString()
	{
		return get_class($this);
	}
}
