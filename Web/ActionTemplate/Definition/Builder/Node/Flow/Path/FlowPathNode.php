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
		$this->addChild($node = $this->getTree()->getNodeFactory()->create('component'));
		$node->setName($name);
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
		$this->addChild($node = $this->getTree()->getNodeFactory()->create('component'));
		$node->setName($name);
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
		$this->addChild($node = $this->getTree()->getNodeFactory()->create('component'));
		$node->setName($name);
		$node->setComponentType(FlowPathComponentNode::TYPE_CONDITION);

		return $node;
	}

	/**
	 * path 
	 *   Add Inner Graph as GraphReferenceNode
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function path($name)
	{
		// Create DefinitionNode for InnerPathReferenceState
		$this->addChild($node = $this->getTree()->getNodeFactory()->create('component'));

		$node->setName($name);
		$node->setComponentType(FlowPathComponentNode::TYPE_INNER_PATH);

		// Create Path Node as Child of PathReferenceState
		$node->addChild($path = $this->getTree()->getNodeFactory()->create('path'));

		return $node;
	}

	public function getDelegatorProvider()
	{
		return $this->getParent()->getDelegatorProvider();
	}
}
