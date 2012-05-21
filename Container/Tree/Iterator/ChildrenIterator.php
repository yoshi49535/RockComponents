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
// @nanemspace
namespace Rock\Component\Container\Tree\Iterator;
// @use Iterator
use Rock\Component\Container\Tree\Node\Node;

class ChildrenIterator 
  implements
    \RecursiveIterator
{
	private $current;

	/**
	 * __construct 
	 * 
	 * @param INode $node 
	 * @access public
	 * @return void
	 */
	public function __construct(Node $node)
	{
		$this->current = $node->getFirstChild();
	}
	/**
	 * rewind 
	 * 
	 * @access public
	 * @return void
	 */
	public function rewind()
	{
		$this->current = $this->current->getParent()->getFirstChild();
	}
	/**
	 * current 
	 * 
	 * @access public
	 * @return void
	 */
	public function current()
	{
		return $this->current;
	}
	/**
	 * key 
	 * 
	 * @access public
	 * @return void
	 */
	public function key()
	{
		return $this->current->getIndex();
	}

	/**
	 * next 
	 * 
	 * @access public
	 * @return void
	 */
	public function next()
	{
		return ($this->current = $this->current->hasNextSibling() ? $this->current->getNextSibling() : null);
	}
	/**
	 * prev 
	 * 
	 * @access public
	 * @return void
	 */
	public function prev()
	{
		return ($this->current = $this->current->getPrevSibling());
	}

	/**
	 * valid 
	 * 
	 * @access public
	 * @return void
	 */
	public function valid()
	{
		return (null !== $this->current);
	}

	/**
	 * getChildren 
	 * 
	 * @access public
	 * @return void
	 */
	public function getChildren()
	{
		return new ChildrenIterator($this->current);
	}

	/**
	 * hasChildren 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasChildren()
	{
		return $this->current->hasChildren();
	}

}
