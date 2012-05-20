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
// @use
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\FlowPathComponentNode;

/**
 * FlowPathNode 
 * 
 * @uses Node
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class FlowPathNode extends Node
{
	/**
	 * state
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function state($name)
	{
		$this->add($node = new FlowPathComponentNode($this->getTree(), $name));
		$node->setComponentType(FlowPathComponentNode::TYPE_STATE);
		return $node;
	}

	/**
	 * show 
	 *   Add Child-Node which converts to "Page" Definition 
	 * 
	 * @param mixed $name 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function page($name, $params = array())
	{
		$this->add($node = new FlowPathComponentNode($this->getTree(), $name));
		$node->setComponentType(FlowPathComponentNode::TYPE_PAGE);

		return $node;
	}

	/**
	 * cond 
	 *  Add Child node which converted to "Condition" Definition 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function cond($name)
	{
		$this->add($node = new FlowPathComponentNode($this->getTree(), $name));
		$node->setComponentType(FlowPathComponentNode::TYPE_PAGE);

		return $node;
	}
}
