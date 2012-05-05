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
