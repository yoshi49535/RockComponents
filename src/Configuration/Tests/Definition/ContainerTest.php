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
namespace Rock\Component\Configuration\Tests\Definition;
// @use Definition
use Rock\Component\Configuration\Definition\Definition;
use Rock\Component\Configuration\Definition\Container;

// @use Test Components
use Rock\Component\Configuration\Tests\Definition\FooComponent;
/** 
 *
 */
class ContainerTest extends BaseTestCase
{
	public function testContainer()
	{
		$container = new Container();

		$definition  = $this->createDefinition();
		$container->addDefinition($definition);

		$instance = $container->get('test');

		$this->assertTrue($instance instanceof FooComponent, 'Assert Component Build.');

		printf("Instance::__toString : %s\n", (string)$instance);
	}

	/**
	 *
	 */
	protected function createDefinition()
	{
		// Create Automaton
		$definition = new Definition('test');
		$definition->setClass('\\Rock\\Component\\Configuration\\Tests\\Definition\\FooComponent');
		$definition->addArgument('test');

		// 
		return $definition;
	}

	public function testAlias()
	{
		$container  = new Container();
		$definition  = $this->createDefinition();
		$definition->setAttribute('alias', 'foo');

		$container->addDefinition($definition);

		$instance = $container->getByAlias('foo');

		$this->assertTrue(!is_null($instance), 'assert not NULL');
		$this->assertTrue($instance instanceof FooComponent, 'assert instanceof FooComponent');
	}
}
