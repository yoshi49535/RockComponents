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
namespace Rock\Component\Configuration\Tests\TestCase;
// @use Definition
use Rock\Component\Configuration\Definition\Definition;

// @use Definition Builder
use Rock\Component\Configuration\Definition\Builder\Tree\TreeDefinitionBuilder;
use Rock\Component\Configuration\Definition\Builder\Tree\DefinitionNode;

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

	public function testTreeBuilder()
	{
		$builder   = new TreeDefinitionBuilder();

		$node      = new DefinitionNode($builder);
		// Set Params
		$node
			->set('class', 'Foo')
		;
		$builder->root()->add($node);

		$definitions = $builder->build();

		$this->assertTrue(count($definitions) === 1, 'Assert Count 1');
		$def = $definitions[0];
		$this->assertTrue($def->getClass() === 'Foo', 'Assert Definition Class');
	}
}
