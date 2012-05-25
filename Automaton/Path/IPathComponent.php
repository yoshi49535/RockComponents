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
namespace Rock\Component\Automaton\Path;
// @extends 
use Rock\Component\Automaton\IAutomatonComponent;

/**
 * IPathComponent 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPathComponent extends IAutomatonComponent
{
	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	function getPath();
}
