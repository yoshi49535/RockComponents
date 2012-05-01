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
namespace Rock\Component\Flow\Tests;

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

