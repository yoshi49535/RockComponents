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
// @use Tree Interface
use Rock\Component\Container\Tree\ITree;
use Rock\Component\Container\Tree\Path\Path;

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
{
	private $tree;
	private $parent;
	private $first;
	private $prev;
	private $next;


	/**
	 * __construct 
	 * 
	 * @param ITree $tree 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree)
	{
		$this->tree  = $tree;
	}

	/**
	 * getTree 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTree()
	{
		return $this->tree;
	}
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

	public function hasChildren()
	{
		return (null !== $this->first);
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
	
	/**
	 * countChildren 
	 * 
	 * @access public
	 * @return void
	 */
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

	public function getChildren()
	{
		$children = array();
		$temp = $this->first;
		do
		{
			$children[] = $temp;
		} while($temp = $temp->getNextSibling());

		return $children;
	}
	/**
	 * getIndex 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIndex()
	{
		return 0;
	}

	// Sibling 
	/**
	 * hasPrevSibling 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasPrevSibling()
	{
		return null !== $this->prev;
	}

	/**
	 * getPrevSibling 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPrevSibling()
	{
		return $this->prev;
	}
	/**
	 * setPrevSibling 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
	public function setPrevSibling(Node $node)
	{
		$node->setParent($this->getParent());

		if(null !== $this->prev)
		{
			$this->prev->next  = $node;
			$node->prev        = $this->prev;
		}

		$this->prev = $node;
		$node->next = $this;

		return $this;
	}

	/**
	 * hasNextSibling 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasNextSibling()
	{
		return null !== $this->next;
	}

	/**
	 * getNextSibling 
	 * 
	 * @access public
	 * @return void
	 */
	public function getNextSibling()
	{
		return $this->next;
	}
	/**
	 * setNextSibling 
	 * 
	 * @param Node $node 
	 * @access public
	 * @return void
	 */
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


	/**
	 * getPathFromRoot 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPathFromRoot()
	{
		$path = new Path($this->getTree());
		
		$temp = $this;
		do
		{
			$path->enque($temp);

		} while($temp = $temp->getParent());
	
		return $path;
	}

}
