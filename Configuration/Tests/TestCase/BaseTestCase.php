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

use Rock\Component\Configuration\Definition\Definition;

interface HogeAware 
{
	function setHoge(Hoge $hoge);
}
class Foo implements HogeAware
{
	protected $text;
	protected $hoge;
	public function __construct($text)
	{
		$this->text  = $text;
	}
	public function __toString()
	{
		return sprintf('FooComponent::$text = %s', (string)$this->text);
	}

	public function setHoge(Hoge $hoge)
	{
		$this->hoge = $hoge;
	}
	public function getHoge()
	{
		return $this->hoge;
	}
}
class Bar
{
	protected $hoge;
	public function __construct(Hoge $hoge)
	{
		$this->hoge = $hoge;
	}
	public function getHoge()
	{
		return $this->hoge;
	}
}
class Hoge
{
	
}

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
	protected function createFooDefinition()
	{
		// Create Automaton
		$definition = new Definition('foo');
		$definition->setClass('\\Rock\\Component\\Configuration\\Tests\\TestCase\\Foo');
		$definition->addArgument('foo');

		// 
		return $definition;
	}
	protected function createBarDefinition()
	{
		// Create Automaton
		$definition = new Definition('bar');
		$definition->setClass('\\Rock\\Component\\Configuration\\Tests\\TestCase\\Bar');

		// 
		return $definition;
	}
	protected function createHogeDefinition()
	{
		// Create Automaton
		$definition = new Definition('hoge');
		$definition->setClass('\\Rock\\Component\\Configuration\\Tests\\TestCase\\Hoge');

		// 
		return $definition;
	}
}
