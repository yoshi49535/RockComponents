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
namespace Rock\Component\Container\Tree\Node;
// @use 
use Rock\Component\Container\Tree\Iterator\TreeIterator;

/**
 * Node 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Node
  implements
    \IteratorAggregate
{
	private $parent;
	private $first;
	private $prev;
	private $next;


	//----
	// Parent
	/**
	 * setParent 
	 * 
	 * @param Node $parent 
	 * @access public
	 * @return void
	 */
	public function setParent(Node $parent)
	{
		$this->parent = $parent;
	}
	
	/**
	 * getParent 
	 * 
	 * @access public
	 * @return void
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * getFirstChild 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFirstChild()
	{
		return $this->first;
	}

	/**
	 * setFirstChild 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
	public function add(Node $node)
	{
		$node->setParent($this);

		if(!$this->first)
			$this->first = $node;
		else
		{
			$temp = $this->first;
			while($temp->hasNextSibling())
				$temp = $temp->getNextSibling();
			$temp->setNextSibling($node);
		}
	}
	
	public function countChildren()
	{
		$count = 0;

		$temp = $this->first;
		while($temp)
		{
			$count++;
			$temp = $temp->getNextSibling();
		}
		return $count;
	}
	public function getIndex()
	{
		return 0;
	}

	// Sibling 
	public function hasPrevSibling()
	{
		return null !== $this->prev;
	}

	public function getPrevSibling()
	{
		return $this->prev;
	}
	public function setPrevSibling(Node $node)
	{
		if(null !== $this->prev)
		{
			$this->prev->next  = $node;
			$node->prev        = $this->prev;
		}

		$this->prev = $node;
		$node->next = $this;

		return $this;
	}

	public function hasNextSibling()
	{
		return null !== $this->next;
	}

	public function getNextSibling()
	{
		return $this->next;
	}
	public function setNextSibling(Node $node)
	{
		// Switch Parent
		$node->setParent($this->getParent());

		if(null !== $this->next)
		{
			$this->next->prev = $node;
			$node->next       = $this->next;
			
		}
		$this->next = $node;
		$node->prev = $this;

		return $this;
	}


	public function getIterator()
	{
		return new TreeIterator($this->first);
	}
}
