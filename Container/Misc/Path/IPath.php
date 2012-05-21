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
namespace Rock\Component\Container\Misc\Path;


/**
 * IPath 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPath
{
	/**
	 * getContainer 
	 * 
	 * @access public
	 * @return void
	 */
	function getContainer();

	/**
	 * getComponents 
	 * 
	 * @access public
	 * @return void
	 */
	function getComponents();
}
