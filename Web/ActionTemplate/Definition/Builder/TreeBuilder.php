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
abstract class TreeBuilder extends BaseBuilder
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
		$node->validate();

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
			// Do not support other, so throw
			$definition = false;
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

		// Initialize Class 
		if(!$definition->getClass() || ($definition->getClass() === '_default'))
			$definition->setClass($this->getFlowClass());

		// Add Call to initialize Flow
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
		
		// Initialize Class 
		if(!$definition->getClass() || ($definition->getClass() === '_default'))
			$definition->setClass($this->getComponentClass($node));
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
		
		// Initialize Class 
		if(!$definition->getClass() || ($definition->getClass() === '_default'))
			$definition->setClass($this->getPathClass());

		// Add Calls for addState, addPage, addCondition
		foreach($node->getChildren() as $child)
		{
			$method = false;
			switch($child->getComponentType())
			{
			case FlowPathComponentNode::TYPE_STATE:
			case FlowPathComponentNode::TYPE_PAGE:
				// add Self Definition
				$definition->addCall(
					new Call('addState', array($child->getReference()))
				);

				break;
			case FlowPathComponentNode::TYPE_CONDITION:
				// Regist Self Definitio 
				$definition->addCall(
					new Call('addCondition', array($child->getReference()))
				);
				break;
			default:
				// Skip for unknown
				throw new \Exception(sprintf('Class "%s" is given, but invalid for Path.', get_class($node)));
				break;
			}

		}

		return $definition;
	}

	protected function getFlowClass()
	{
		return '\\Rock\\Component\\Flow\\Flow';
	}

	abstract protected function getPathClass();
	abstract protected function getComponentClass(FlowPathComponentNode $node);
}
