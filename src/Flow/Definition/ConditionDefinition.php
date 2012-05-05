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
// @use Call
use Rock\Component\Configuration\Definition\Call;
// @use Component Reference
use Rock\Component\Configuration\Definition\Reference;

/**
 *
 */
class ConditionDefinition extends FlowComponentDefinition
  implements
    IFlowComponentDefinition
{
	/**
	 *
	 */
	protected $graph;
	/**
	 *
	 */
	protected $source;
	/**
	 *
	 */
	protected $target;
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);

		$this->class   = '\\Rock\\Component\\Automaton\\Condition\\Condition'; 
	}

	/**
	 * @override Definition
	 */
	public function getArguments()
	{
		return array(
			$this->getSource(),
			$this->getTarget()
		);
	}
	/**
	 *
	 */
	public function setSource(Reference $reference)
	{
		$this->source  = $reference;
	}
	/**
	 *
	 */
	public function getSource()
	{
		return $this->source;
	}
	/**
	 *
	 */
	public function setTarget(Reference $reference)
	{
		$this->target  = $reference;
	}

	/**
	 *
	 */
	public function getTarget()
	{
		return $this->target;
	}

	/**
	 *
	 */
	public function setGraph(GraphDefinition $definition)
	{
		parent::setGraph($definition);

		// Add addEdge method call on graph construct
		$definition->addCall(
			new Call(
				'addEdge',
				array($this->getReference())
			)
		);
	}
}
