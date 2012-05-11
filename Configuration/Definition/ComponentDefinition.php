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
final class ComponentDefinition extends Definition
{
	
	protected $parent;

	public function __construct($id, $attributes = array(), Definition $parent = null)
	{
		$this->parent  = $parent;

		parent::__construct($id, $attributes);
	}

	public function configureDefinition()
	{
		if($this->parent)
			$this->parent->configureDifition();
	}
	public function instantiate($params = array())
	{
		return $this;
	}
}
