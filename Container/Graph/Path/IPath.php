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
namespace Rock\Component\Container\Graph\Path;
// @extends
use Rock\Component\Container\Misc\Path\IPath as IBasePath;

/**
 * IPath 
 * 
 * @uses IBasePath
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPath extends IBasePath
{
	/**
	 *
	 */
	function getGraph();

	/**
	 *
	 */
	function getVertices();

	/**
	 *
	 */
	function getEdges();
}
