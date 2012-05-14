<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/
// @namespace
namespace Rock\Component\Flow\Definition\Path\Component;
// @use Path Interface
use Rock\Component\Flow\Definition\Path\IPathDefinition;

/**
 * IPathComponentDefinition 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPathComponentDefinition
{
	/**
	 * getPathDefinition 
	 * 
	 * @access public
	 * @return void
	 */
	function getPathDefinition();

	/**
	 * setPathDefinition 
	 * 
	 * @param IPathDefinition $definition 
	 * @access public
	 * @return void
	 */
	function setPathDefinition(IPathDefinition $definition);
}
