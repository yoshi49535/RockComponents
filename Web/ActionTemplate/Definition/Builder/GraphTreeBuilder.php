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
// @namesapce
namespace Rock\Component\Web\ActionTemplate\Definition\Builder;
//
use Rock\Component\Configuration\Definition\Builder\Tree\IDefinitionNode;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\FlowPathComponentNode;

/**
 * GraphTreeBuilder 
 * 
 * @uses TreeBuilder
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class GraphTreeBuilder extends TreeBuilder
{
	/**
	 * getPathClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getPathClass()
	{
		return '\\Rock\\Component\\Flow\\Graph\\FlowGraph';
	}
	/**
	 * getComponentClass 
	 * 
	 * @param Node $node 
	 * @access protected
	 * @return void
	 */
	protected function getComponentClass(FlowPathComponentNode $node)
	{
		$class = false;
		switch($node->getComponentType())
		{
		case FlowPathComponentNode::TYPE_STATE:
			$class = '\\Rock\\Component\\Flow\\Graph\\Vertex\\State';
			break;
		case FlowPathComponentNode::TYPE_PAGE:
			$class = '\\Rock\\Component\\Web\\Flow\\Graph\\Vertex\\Page';
			break;
		case FlowPathComponentNode::TYPE_CONDITION:
			$class = '\\Rock\\Component\\Flow\\Graph\\Edge\\Condition';
			break;
		default:
			throw new \Exception(sprintf('Invalid Component Type is given.'));
		}

		return $class;
	}
}
