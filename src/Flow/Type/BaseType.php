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

		// Configurate Graph Path Template
		$this->configure();

		//
		parent::doConfigurateDefinition();
	}
	/**
	 * configure 
	 *  Configuration of the Graph Path.
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function configure();
	
	// Shortcut Method-Chain Functions
	/**
	 * addState 
	 * Add StateDefinition into GraphDefinition
	 * 
	 * @param mixed $name 
	 * @param mixed $callback 
	 * @access public
	 * @return void
	 */
	public function addState($name, $callback = null, array $params = array())
	{
		// merge parameters
		$params = array_merge(
			// Defaults
			array(
				'class' => $this->defaultStateClass,
				'attributes' => array()
			), 
			$params);
		
		// merge attributes
		$attrs  = array_merge(
			$params['attributes'],
			array(
				'name'    => $name,
				'handler' => $callback
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
	public function addCondition($callback, array $params = array())
	{
		// merge parameters
		$params = array_merge(
			// Defaults
			array(
				'class' => $this->defaultConditionClass,
				'attributes' => array()
			), 
			$params);
		
		// merge attributes
		$attrs  = array_merge(
			$params['attributes'],
			array(
				'validator' => $callback
			));
		
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
}
