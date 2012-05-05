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
// @extend

// @use Call
use Rock\Component\Configuration\Definition\Call;

/**
 *
 */
class StateDefinition extends FlowComponentDefinition
{
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = '\\Rock\\Component\\Flow\\Graph\\State\\State';
	}

	/**
	 *
	 */
	public function getArguments()
	{
		return array(
			$this->getGraph()->getReference(), 
			$this->hasAttribute('name') ? $this->getAttribute('name') : $this->getId(), 
			$this->hasAttribute('handler') ? $this->getAttribute('handler') : null
		);
	}

	/**
	 *
	 */
	public function setGraph(GraphDefinition $graph)
	{
		parent::setGraph($graph);

		$graph->addCall(
			new Call(
				'addVertex',
				array($this->getReference())
			)
		);
	}
}
