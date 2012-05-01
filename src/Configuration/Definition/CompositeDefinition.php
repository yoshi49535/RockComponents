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
class CompositeDefinition extends Definition
{
	/**
	 * @var
	 */
	protected $children  = array();

	/**
	 *
	 */
	public function addChild($id, $ns = self::DEFAULT_NS)
	{
		if(!isset($this->children[$ns]))
			$this->children[$ns] = array();

		// push new id
		$this->children[$ns][]  = $id;	
	}

	/** 
	 *
	 */
	public function getChildrenIds($ns = false)
	{
		if(!$ns)
		{
			// flat 
			return array();
		}
		else
		{
			return $this->children[$ns];
		}
	}
}
