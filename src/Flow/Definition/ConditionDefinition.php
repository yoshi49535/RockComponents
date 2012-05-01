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
