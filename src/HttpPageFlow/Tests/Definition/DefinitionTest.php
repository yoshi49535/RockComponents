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
namespace Rock\Component\Flow\Tests\Definition;
// @extend
use Rock\Component\Flow\Tests\BaseTestCase;
// @use Definition
use Rock\Component\Flow\Definition\FlowDefinition;
use Rock\Component\Flow\Definition\StateDefinition;
//use Rock\Component\Flow\Definition\Definition;

/**
 *
 */
class DefinitionTest extends BaseTestCase
{
	public function testCreate()
	{
		// Create Automaton
		$definition = new FlowDefinition('flow');
		$definition->addArgument('test');
		// 
		
		//$state      = new StateDefinition('flow.step.first');
		//$definition->addStateDefinition($state);
	}
}

