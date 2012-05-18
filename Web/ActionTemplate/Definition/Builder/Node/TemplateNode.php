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
namespace Rock\Component\Web\ActionTemplate\Definition\Builder\Node;
// @use Node
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Node;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\FlowNode;

/**
 * ActionTemplateNode 
 * 
 * @uses Node
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class TemplateNode extends Node
{
	/**
	 * set 
	 * 
	 * @access public
	 * @return void
	 */
	public function set()
	{
	}

	/**
	 * flow 
	 * 
	 * @access public
	 * @return void
	 */
	public function flow()
	{
		$this->add($node = new FlowNode());
		return $node;
	}
}
