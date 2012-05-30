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
namespace Rock\Component\Container\Tree\Path;
// @extends
use Rock\Component\Container\Misc\Path\AbstractPath;
// @se
use Rock\Component\Container\Tree\ITree;

/**
 * Path 
 * 
 * @uses AbstractPath
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Path extends AbstractPath
  implements
    IPath
{
	/**
	 * __construct 
	 * 
	 * @param ITree $tree 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree)
	{
		parent::__construct($tree);
	}

	/**
	 * enque 
	 * 
	 * @param mixed $component 
	 * @access public
	 * @return void
	 */
	public function enque($component)
	{
		$this->enqueComponent($component);
	}
}
