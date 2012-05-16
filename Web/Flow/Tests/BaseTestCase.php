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
namespace Rock\Component\Web\Flow\Tests;

class FooComponent
{
	protected $text;
	public function __construct($text)
	{
		$this->text  = $text;
	}
	public function __toString()
	{
		return sprintf('FooComponent::$text = %s', (string)$this->text);
	}
}
class BarComponent 
{
	
}
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
	
}

