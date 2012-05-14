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
	public function __construct(array $attributes = array())
	{
		parent::__construct('edge', $attributes);

		$this->class   = '\\Rock\\Component\\Automaton\\Graph\\Edge\\Condition'; 
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
	 * getTarget 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTarget()
	{
		return $this->target;
	}

	/**
	 * doConfigurateDefinition 
	 * 
	 * @override Rock\Configuration\Definition\Definition
	 * @access protected
	 * @return void
	 */
	protected function doConfigurateDefinition()
	{
		if($this->hasAttribute('validator'))
		{
			$this->addCall(new Call(
				'setValidator',
				array($this->getAttribute('validator'))
			));
		}

	}

	/**
	 * getId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getId()
	{
		if(!$this->source || !$this->target)
			throw new \Exception('Bad ID request');
		return sprintf('edge.%s.to.%s', $this->getSource()->getId(), $this->getTarget()->getId());
	}
}
