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
namespace Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path;
// @extends
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Node;

class FlowPathComponentNode extends Node
{
	const TYPE_STATE      = 'state';
	const TYPE_PAGE       = 'page';
	const TYPE_CONDITION  = 'cond';

	/**
	 * type 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $type;

	/**
	 * setComponentType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function setComponentType($type)
	{
		switch($type)
		{
		case self::TYPE_STATE:
		case self::TYPE_PAGE:
		case self::TYPE_CONDITION:
			$this->type  = $type;
			break;
		default:
			throw new \Exception('Invalid Type is given.');
		}
	}

	/**
	 * getComponentType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getComponentType()
	{
		return $this->type;
	}
}
