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
namespace Rock\Component\Configuration\Tests\Definition;
// @use Definition
use Rock\Component\Configuration\Definition\Definition;

/**
 *
 */
class DefinitionTest extends BaseTestCase
{
	
	public function testCreate()
	{
		// Create Automaton
		$definition = new Definition('id');
		$definition->setClass('\\Rock\\Component\\Configuration\\Tests\\Definition\\FooComponent');
		$definition->addArgument('test');
		// 
	}
}
