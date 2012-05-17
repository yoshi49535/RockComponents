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
	public function addChild($id)
	{
		if(!isset($this->children))
			$this->children = array();

		// push new id
		$this->children[]  = $id;	
	}

	/** 
	 *
	 */
	public function getChildrenIds()
	{
		return $this->children;
	}

	protected function doConfigurateDefinition()
	{
		foreach($this->children as $child)
		{
			$child->configurateDefinition();
		}
	}
}