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
use Rock\Component\Configuration\Definition\CompositeDefinition;

/**
 *
 */
class GraphDefinition extends CompositeDefinition
{
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = '\\Rock\\Component\\Flow\\Graph\\FlowGraph';
	}

	public function addChild($component)
	{
		parent::addChild($component);
		if($component instanceof IFlowComponentDefinition)
		{
			$component->setGraphDefinition($this);
		}
	}
}
