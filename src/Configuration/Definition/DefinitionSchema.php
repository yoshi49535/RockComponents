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

class DefinitionSchema extends Definition
{
	/**
	 * @var
	 */
	protected $children  = array();

	/**
	 *
	 */
	public function addChild($id, Definition $definition)
	{
		$this->children[]  = $id;
		
		// regist into container
		$this->container->set($id, $definition);
	}

	/** 
	 *
	 */
	public function getChildrenIds()
	{
		return $this->children;
	}
}
