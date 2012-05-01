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
