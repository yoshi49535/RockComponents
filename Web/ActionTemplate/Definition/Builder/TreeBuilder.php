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
// @use
use Rock\Component\Configuration\Definition\Builder\Tree\TreeDefinitionBuilder as BaseBuilder;
// @use Definition Node
use Rock\Component\Configuration\Definition\Builder\Tree\IDefinitionNode;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\RootNode;
// @use DefinitionNodes
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\FlowNode;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\FlowPathNode;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\FlowPathComponentNode;
// @use Definition
use Rock\Component\Configuration\Definition\Definition;
use Rock\Component\Configuration\Component\Call;

/**
 * TreeBuilder 
 * 
 * @uses Tree
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class TreeBuilder extends BaseBuilder
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->initRoot(new RootNode($this, ''));
	}

	/**
	 * buildDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access public
	 * @return void
	 */
	public function buildDefinition(IDefinitionNode $node)
	{
		switch(true)
		{
		case ($node instanceof FlowNode):
			$definition = $this->doBuildFlowDefinition($node);
			break;
		case ($node instanceof FlowPathNode):
			$definition = $this->doBuildPathDefinition($node);
			break;
		case ($node instanceof FlowPathComponentNode):
			$definition = $this->doBuildPathComponentDefinition($node);
			break;
		default:
			throw new \Exception(sprintf('Invalid Component Node Class "%s" is given', get_class($node)));
			break;
		}
		return $definition;
	}

	/**
	 * doBuildFlowDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access protected
	 * @return void
	 */
	protected function doBuildFlowDefinition(IDefinitionNode $node)
	{
		$definition = new Definition($node->generateId(), $node->getParameterBag()->all());

		if(!$definition->getClass() || ($definition->getClass() === '_default'))
		{
			$definition->setClass('\\Rock\\Component\\Flow\\Flow');
		}
		$definition->addCall(new Call(
			'setPath',
			array($node->getFirstChild()->getReference())
		));

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
		$definition = new Definition($node->generateId(), $node->getParameterBag()->all());
		
		// Add Calls for addState, addPage, addCondition
		switch($node->getComponentType())
		{
		case FlowPathComponentNode::TYPE_STATE:
		case FlowPathComponentNode::TYPE_PAGE:
			$definition->setArguments(array(
				$node->getParameter('name'),
			));
			break;
		case FlowPathComponentNode::TYPE_CONDITION:
			$definition->setArguments(array(
				$node->getParameter('name'),
				$node->getPrevSibling()->getReference(),
				$node->getNextSibling()->getReference(),
			));
			break;
		default:
			// Skip for unknown
			throw new \Exception(sprintf('Class "%s" is given, but invalid for PathComponent.', get_class($node)));
			break;
		}


		return $definition;
	}
	/**
	 * doBuildDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access protected
	 * @return void
	 */
	protected function doBuildPathDefinition(IDefinitionNode $node)
	{
		$definition = new Definition($node->generateId(), $node->getParameterBag()->all());
		
		// Add Calls for addState, addPage, addCondition
		foreach($node->getChildren() as $child)
		{
			$method = false;
			switch($child->getComponentType())
			{
			case FlowPathComponentNode::TYPE_STATE:
				$method = 'addState';
				break;
			case FlowPathComponentNode::TYPE_PAGE:
				$method = 'addPage';
				break;
			case FlowPathComponentNode::TYPE_CONDITION:
				$method = 'addCondition';
				break;
			default:
				// Skip for unknown
				throw new \Exception(sprintf('Class "%s" is given, but invalid for Path.', get_class($node)));
				break;
			}

			if($method)
				$definition->addCall(
					new Call($method, array($child->getReference()))
				);
		}

		return $definition;
	}
}
