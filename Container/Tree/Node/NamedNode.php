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
// @extends
use Rock\Component\Container\Tree\Node\Node;
// @interface
use Rock\Component\Container\INamedComponent;
// @use
use Rock\Component\Container\Tree\ITree;

/**
 * Node 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class NamedNode extends Node
  implements
    INamedComponent
{
	private $name;
	/**
	 * __construct 
	 * 
	 * @param ITree $tree 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree, $name)
	{
		parent::__construct($tree);

		$this->name = $name;
	}

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name  = $name;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->name;
	}
}

