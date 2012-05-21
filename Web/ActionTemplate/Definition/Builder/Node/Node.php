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
// @use 
use Rock\Component\Configuration\Definition\Builder\Tree\DefinitionNode;

/**
 * Node 
 * 
 * @uses DefinitionNode
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Node extends DefinitionNode
  implements
    IActionTemplateDefNode
{
	protected function init()
	{
		$this->setParameter('class', '_default');
	}
	/**
	 * end 
	 * 
	 * @access public
	 * @return void
	 */
	public function end()
	{
		return $this->getParent();
	}
	/**
	 * asPrevSiblign 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
	public function asPrevSiblign(Node $node)
	{
		$temp = $this->getPrevSiblign();
		
		if($this->hasPrevSiblign())
		{
			$this->getPrevSiblign()->setNextSiblign($node);
			$node->setPrevSiblign($this->getPrevSiblign());
		}
		$this->setPrevSiblign($node);
		$node->setNextSiblign($this);
	}

	/**
	 * asNextSiblign 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
	public function asNextSiblign(Node $node)
	{
		if($this->hasNextSiblign())
		{
			$this->getNextSiblign()->setPrevSiblign($node);
			$node->setNextSiblign($this->getNextSiblign());
		}
		$this->setNextSiblign($node);
		$node->setPrevSiblign($this);

		return $node;
	}

	/**
	 * asChildNode 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
	public function asChildNode(Node $node)
	{
		$node->setParent($this);
		return $node;
	}

	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate()
	{
		$name = $this->getName();
		if(!$name || empty($name))
			throw new \Exception('Name is not specified for Node.');
	}

}
