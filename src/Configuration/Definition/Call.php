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
namespace Rock\Component\Configuration\Definition;

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
