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
use Rock\Component\Configuration\Definition\Definition as BaseDefinition;

// @use Component Reference
use Rock\Component\Configuration\Definition\Reference;

/**
 *
 */
abstract class FlowComponentDefinition extends BaseDefinition
  implements
    IFlowComponentDefinition
{

	protected $graph;
	public function getGraph()
	{
		return $this->graph;
	}
	public function setGraph(GraphDefinition $definition)
	{
		$this->graph  = $definition;
	}
}
