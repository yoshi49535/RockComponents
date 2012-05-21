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
// @extends
use Rock\Component\Container\IContainer;

/**
 * ITree 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ITree extends IContainer
{
	/**
	 * getRoot 
	 * 
	 * @access public
	 * @return void
	 */
	function getRoot();
}
