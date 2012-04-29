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
// <Namespace>
namespace Rock\Component\Flow\Definition;

/**
 *
 */
class Definition extends BaseDefinition
{
	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *
	 */
	public function end()
	{
		return $this->parent;
	}
}
