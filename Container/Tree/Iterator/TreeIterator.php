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
// @use TreeInterface
use Rock\Component\Container\Tree\ITree;

class TreeIterator
  implements
    \Iterator
{
	const PREORDER  = 'preorder';
	const POSTORDER = 'postorder';
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strategy;
	/**
	 * tree 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tree;
	/**
	 * current 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $current;

	/**
	 * __construct 
	 * 
	 * @param Node $node 
	 * @param mixed $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree, $strategy = self::PREORDER)
	{
		$this->strategy = $strategy;
		$this->tree     = $tree;
		
		// Initialize current for specified strategy
		$this->rewind();
	}


	/**
	 * rewind 
	 * 
	 * @access public
	 * @return void
	 */
	public function rewind()
	{
		switch($this->strategy)
		{
		// Top most
		case self::PREORDER:
			$this->current = $this->tree->getRoot();
			break;
		// Left most
		case self::POSTORDER:
			$temp  = $this->tree->getRoot();
			while($temp->hasChildren())
			{
				$temp  = $temp->getFirstChild();
			}

			$this->current = $temp;
			break;
		default:
			throw new \Exception('Invalid strategy to traverse iterator.');
			break;
		}
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
	 * valid 
	 * 
	 * @access public
	 * @return void
	 */
	public function valid()
	{
		return null !== $this->current;
	}

	public function next()
	{
		switch($this->strategy)
		{
		case self::PREORDER:
			if($this->current->hasChildren())
				$this->current = $this->current->getFirstChild();
			else
				while($this->current)
				{
					if($this->current->hasNextSibling())
					{
						$this->current = $this->current->getNextSibling();
						break;
					}

					$this->current = $this->current->getParent();
				}
			break;
		case self::POSTORDER:
			if($this->hasNextSibling())
			{
				$this->current = $this->current->getNextSibling();
				while($this->current->hasChildren())
					$this->current = $this->current->getFirstChild();
			}
			else 
			{
				$this->current = $this->getParent();
			}
			break;
		default:
			throw new \Exception('Invalid strategy to traverse iterator.');
			break;
		}
		return $this->current;
	}
}
