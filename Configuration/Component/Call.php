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
namespace Rock\Component\Configuration\Component;

/**
 *
 */
class Call
{
	/**
	 *
	 */
	protected $method;

	/**
	 *
	 */
	protected $arguments;

	/**
	 *
	 */
	public function __construct($method, $arguments = array())
	{
		$this->method    = $method;
		$this->arguments = $arguments;
	}

	/**
	 *
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 *
	 */
	public function addArgument($argument)
	{
		$this->arguments[]  = $argument;
	}

	/**
	 *
	 */
	public function getArguments()
	{
		return $this->arguments;
	}
}
