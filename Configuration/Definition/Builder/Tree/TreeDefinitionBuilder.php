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
namespace Rock\Component\Configuration\Definition\Builder\Tree;
// @extends
use Rock\Component\Container\Tree\Tree;
// @interface
use Rock\Component\Configuration\Definition\Builder\IDefinitionBuilder;
// @use Container
use Rock\Component\Configuration\Container\IContainer;
// @use
use Rock\Component\Configuration\Definition\Definition;
use Rock\Component\Configuration\Definition\Definition\Builder\Tree\DefinitionNode;
// @use Iterator
use Rock\Component\Container\Tree\Iterator;
// 
use Rock\Component\Container\Tree\Node\Factory\NodeFactory;

/**
 * TreeDefinitionBuilder 
 * 
 * @uses Tree
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class TreeDefinitionBuilder extends Tree 
  implements
    IDefinitionBuilder,
	ITreeBuilder
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	private $nodeFactory;
	
	/**
	 * __construct 
	 * 
	 * @param IContainer $container 
	 * @access public
	 * @return void
	 */
	public function __construct(IContainer $container)
	{
		$this->container = $container;

		$this->nodeFactory = new NodeFactory($this);
	}
	/**
	 * root 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function root($name = null)
	{
		$root = $this->getRoot();
		if($name)
			$root->setName($name);

		return $root;
	}
	/**
	 * build 
	 *   Build All Definitions 
	 * @param mixed $itr 
	 * @access protected
	 * @return void
	 */
	public function build()
	{
		$definitions = $this->doBuild(new Iterator\ChildrenIterator($this->getRoot()));

		return $definitions;
	}

	/**
	 * doBuild 
	 * 
	 * @param mixed $itr 
	 * @access protected
	 * @return void
	 */
	protected function doBuild(\Iterator $itr)
	{
		$definitions = array();

		// Validate all node Before build each
		$this->validate();

		if($itr && $itr->valid())
		{
			$definitions[] = $itr->current()->getDefinition();

			// Build for children
			if($itr->hasChildren())
			{
				$childItr = $itr->getChildren();
				while($childItr && $childItr->valid())
				{
					// 
					$definitions = array_merge($definitions, $this->doBuild($childItr));
					//forward Iterator
					$childItr->next();
				}
			}
		}

		return $definitions;
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
		
		$definition = new Definition($node->getParameter('id'), $node->getParameterBag()->all());

		return $definition;
	}

	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate()
	{
		// "preorder" access iterator
		$itr = $this->getIterator();

		//
		do {
			$itr->current()->validate();
		} while($itr->next() && $itr->valid());
	}

	public function getContainer()
	{
		return $this->container;
	}

	public function getNodeFactory()
	{
		return $this->nodeFactory;
	}
}

