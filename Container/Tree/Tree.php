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
namespace Rock\Component\Container\Tree;
// @use Iterator
use Rock\Component\Container\Tree\Node\Node;
// @use Iterator
use Rock\Component\Container\Tree\Iterator\TreeIterator;


/**
 * Tree 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Tree
  implements
  	ITree,
    \IteratorAggregate
{
	private $root;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->initRoot();
	}

	/**
	 * initRoot 
	 * 
	 * @param Node $root 
	 * @access protected
	 * @return void
	 */
	protected function initRoot(Node $root = null)
	{
		if($root)
			$this->root = $root;
		else
			$this->root = new Node($this);
	}

	/**
	 * getRoot 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new TreeIterator($this);
	}
}
