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
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\PathComponentNode;

/**
 * PathNode 
 * 
 * @uses Node
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class PathNode extends Node
{
	protected function init()
	{
		$this->setParameter('class', '%flow.path.class%');
	}
	/**
	 * state
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function state($name)
	{
		$this->add($node = new PathComponentNode());
		$node->set('class', '%flow.path.state.class%');
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
		$this->add($node = new PathComponentNodeNode());
		$node->set('class', '%flow.path.page.class%');

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
		$this->add($node = new PathComponentConditionNode());
		$node->set('class', '%flow.path.condition.class%');

		return $node;
	}
}
