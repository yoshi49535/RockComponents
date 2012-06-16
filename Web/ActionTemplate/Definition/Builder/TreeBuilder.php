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
use Rock\Component\Configuration\Container\IContainer;
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
// @use Exception
use Rock\Component\Configuration\Exception\DefinitionException;

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
	 * flowDefinition 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $flowDefinition;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(IContainer $container)
	{
		parent::__construct($container);

		$this->getNodeFactory()->add('flow', '\\Rock\\Component\\Web\\ActionTemplate\\Definition\\Builder\\Node\\Flow\\FlowNode');
		$this->getNodeFactory()->add('path', '\\Rock\\Component\\Web\\ActionTemplate\\Definition\\Builder\\Node\\Flow\\Path\\FlowPathNode');
		$this->getNodeFactory()->add('state', '\\Rock\\Component\\Web\\ActionTemplate\\Definition\\Builder\\Node\\Flow\\Path\\FlowPathStateNode', array('component_name' => 'state'));
		$this->getNodeFactory()->add('page', '\\Rock\\Component\\Web\\ActionTemplate\\Definition\\Builder\\Node\\Flow\\Path\\FlowPathStateNode', array('component_name' => 'page'));
		$this->getNodeFactory()->add('condition', '\\Rock\\Component\\Web\\ActionTemplate\\Definition\\Builder\\Node\\Flow\\Path\\FlowPathConditionNode');
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
		$this->flowDefinition = $definition;

		// Initialize Class 
		if(!$definition->getClass() || ($definition->getClass() === '_default'))
			$definition->setClass($this->getFlowClass());

		$definition->addCall(new Call(
			'setName', 
			array($node->getName())
		));
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
		switch($node->getComponentName())
		{
		case 'page':
		case 'state':
			$definition->setArguments(array(
				$node->getParameter('name'),
			));
			break;
		case 'condition':
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

		if($node->getParameter('is_entry', false))
		{
			$definition->addCall(new Call('asEntryPoint'));
		}
		// add Call for Delegates
		if($delegates= $node->getDelegates())
		{
			// Default Provider
			$provider = $node->getDelegatorProvider();
			if($provider)
				$provider = $this->getContainer()->getReferenceOf($provider);


			foreach($delegates as $delegate)
			{
				//
				if(is_array($delegate))
				{
					$definition->addCall(new Call(
						'addDelegatorWithProvider',
						array(
							$this->getContainer()->getReferenceOf($delegate[0]),
							array('method' => $delegate[1])
						)
					));
				}
				else
				{
					if(!$provider)
						throw new DefinitionException('Node cannot delegate without DelegatorProvider. Please specify with FlowPathComponentNode::provider() first');
					$definition->addCall(new Call(
						'addDelegatorWithProvider',
						array(
							$provider, 
							array('method' => $delegate)
						)
					));
				}
			}
		}
		
		// Regist Alias on Flow
		$this->getFlowDefinition()->addCall(new Call(
			'setAliasComponent',
			array($node->getName(), $definition->getReference())
		));

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
			switch($child->getComponentName())
			{
			case 'state':
			case 'page':
				// add Self Definition
				$definition->addCall(
					new Call('addState', array($child->getReference()))
				);

				break;
			case 'condition':
				// Regist Self Definitio 
				$definition->addCall(
					new Call('addCondition', array($child->getReference()))
				);
				break;
			default:
				// Skip for unknown
				throw new \Exception(sprintf('Class "%s" is given, but invalid for Path.', get_class($child)));
				break;
			}
		}

		$this->getFlowDefinition()->addCall(new Call(
			'setAliasComponent',
			array($node->getName(), $definition->getReference())
		));
		return $definition;
	}

	/**
	 * getFlowClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getFlowClass()
	{
		return '\\Rock\\Component\\Flow\\Flow';
	}
	/**
	 * getFlowDefinition 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getFlowDefinition()
	{
		if(!$this->flowDefinition)
			throw new \Exception('FlowDefinition is not built yet.');
		//
		return $this->flowDefinition;
		
	}

	/**
	 * getPathClass 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function getPathClass();
	/**
	 * getComponentClass 
	 * 
	 * @param FlowPathComponentNode $node 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function getComponentClass(FlowPathComponentNode $node);
}
