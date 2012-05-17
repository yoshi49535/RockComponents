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
		$this->root  = new Node();
	}

	/**
	 * root 
	 * 
	 * @access public
	 * @return void
	 */
	public function root()
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
		return $this->root->getIterator();
	}
}
