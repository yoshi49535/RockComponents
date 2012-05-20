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
	 * doBuildPathDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access protected
	 * @return void
	 */
	protected function doBuildPathDefinition(IDefinitionNode $node)
	{
		$definition = parent::doBuildPathDefinition($node);
		if($definition)
		{
			// If Class is not specified, or _default is given, 
			// replace it.
			if(!$definition->getClass() || ($definition->getClass() === '_default'))
			{
				$definition->setClass('\\Rock\\Component\\Flow\\Graph\\FlowGraph');
			}
		}
		return $definition;
	}
	/**
	 * doBuildPathComponentDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access protected
	 * @return void
	 */
	protected function doBuildPathComponentDefinition(IDefinitionNode $node)
	{
		$definition = parent::doBuildPathComponentDefinition($node);


		if(!$definition->getClass() || ($definition->getClass() === '_default'))
		{
			switch($node->getComponentType())
			{
			case FlowPathComponentNode::TYPE_STATE:
				$definition->setClass('\\Rock\\Component\\Flow\\Graph\\Vertex\\State');
				break;
			case FlowPathComponentNode::TYPE_PAGE:
				$definition->setClass('\\Rock\\Component\\Web\\Flow\\Graph\\Vertex\\Page');
				break;
			case FlowPathComponentNode::TYPE_CONDITION:
				$definition->setClass('\\Rock\\Component\\Automaton\\Graph\\Edge\\Condition');
				break;
			default:
				throw new \Exception(sprintf('Invalid Component Type is given.'));
			}
		}

		return $definition;
	}

}
