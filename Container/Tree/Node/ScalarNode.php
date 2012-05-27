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
namespace Rock\Component\Container\Tree\Node;
// @use Tree Interface
use Rock\Component\Container\Tree\ITree;

/**
 * ScalarNode 
 * 
 * @uses Node
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ScalarNode extends Node
//  implements
//    IScalar
{
	private $scalar;

	/**
	 * __construct 
	 * 
	 * @param mixed $scalar 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree, $scalar = null)
	{
		parent::__construct($tree);
		$this->scalar  = $scalar;
	}
	/**
	 * getScalar 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScalar()
	{
		return $this->scalar;
	}
}
