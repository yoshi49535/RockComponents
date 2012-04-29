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
class Definition
{
	/** 
	 * @var
	 */
	protected $id;
	/** 
	 * @var
	 */
	protected $class;
	/** 
	 * @var
	 */
	protected $attributes;
	
	/**
	 *
	 */
	public function __construct($id, $attributes = array())
	{
		$this->id          = $id;
		$this->attributes  = $attributes;
	}

	/**
	 *
	 */
	public function getId()
	{
		return $this->id;
	}
	/**
	 *
	 */
	public function setAttribute($attribute, $value)
	{
		// 
		$this->attributes[$name] = $value;
	}

	/**
	 *
	 */
	public function getAttribute()
	{
	}
	/**
	 *
	 */
	public function getAttributes()
	{
		
	}
	/**
	 *
	 */
	public function replaceAttributes()
	{
		
	}

	/**
	 *
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 *
	 */
	public function setClass($class)
	{
		$this->class  = $class;
	}

	/**
	 *
	 */
	public function setArguments(array $arguments)
	{
		$this->arguments  = $arguments;
	}
	/**
	 *
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 *
	 */
	public function addArgument($argument)
	{
		$this->arguments[] = $argument;
	}
}
