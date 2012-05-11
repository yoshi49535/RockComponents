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

