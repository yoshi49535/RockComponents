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

namespace Rock\Component\Flow\Traversal;

/**
 * ITraversal 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IFlowTraversal
{
	/**
	 * isHandled 
	 * 
	 * @access public
	 * @return void
	 */
	function isHandled();

	/**
	 * isKeepAlive 
	 * 
	 * @access public
	 * @return void
	 */
	function isKeepAlive();

	/**
	 * setKeepAlive 
	 * 
	 * @param bool $bAlive 
	 * @access public
	 * @return void
	 */
	function setKeepAlive($bAlive);
}
