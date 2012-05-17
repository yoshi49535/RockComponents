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
use Rock\Component\Configuration\Container\Container;
use Rock\Component\Configuration\Container\InjectionContainer;

// @use Test Components
use Rock\Component\Configuration\Tests\TestCase\Foo;
use Rock\Component\Configuration\Tests\TestCase\Bar;
use Rock\Component\Configuration\Tests\TestCase\Hoge;
use Rock\Component\Configuration\Tests\TestCase\HogeAware;
use Rock\Component\Configuration\Filter\InterfaceAwareInjectionFilter;
/** 
 *
 */
class ContainerTest extends BaseTestCase
{
	public function testContainer()
	{
		$container = new Container();

		$definition  = $this->createFooDefinition();
		$container->addDefinition($definition);

		$instance = $container->get('foo');

		$this->assertTrue($instance instanceof Foo, sprintf('Assert Component Build, but %s.', get_class($instance)));
	}


	public function testAlias()
	{
		$container  = new Container();
		$definition  = $this->createFooDefinition();
		$definition->setAlias('abc');

		$container->addDefinition($definition);

		$instance = $container->getByAlias('abc');

		$this->assertTrue(!is_null($instance), 'assert not NULL');
		$this->assertTrue($instance instanceof Foo, 'assert instanceof Foo');
	}

	public function testReference()
	{
		$container  = new Container();
		$bar        = $this->createBarDefinition();
		$hoge       = $this->createHogeDefinition();
		$bar->addArgument($hoge->getReference());

		$container->addDefinition($bar);
		$container->addDefinition($hoge);

		$instance = $container->get('bar');

		$this->assertTrue($instance instanceof Bar, 'assert instanceof Bar');
		$this->assertTrue($instance->getHoge() instanceof Hoge, 'assert instanceof Hoge');

	}
	public function testAware()
	{
		$container  = new InjectionContainer();

		$container->addDefinition($hoge = $this->createHogeDefinition());
		$container->addFilter(
			new InterfaceAwareInjectionFilter(
				'test', 
				'\\Rock\\Component\\Configuration\\Tests\\TestCase\\HogeAware',
				'setHoge',
				$hoge->getReference()
			));
		$foo   = $this->createFooDefinition();

		$container->addDefinition($foo);

		$instance = $container->get('foo');

		$this->assertTrue(($instance instanceof Foo), 'Assert Instance');
		$this->assertTrue(($instance instanceof HogeAware), 'Assert Interface');
		$this->assertTrue(($instance->getHoge() instanceof Hoge), sprintf('Assert Aware Hoge, but %s', get_class($instance->getHoge())));
	}


}
