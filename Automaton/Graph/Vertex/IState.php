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

namespace Rock\Component\Automaton\Graph\Vertex;

/**
 * IState 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IState
{
	/**
	 * isEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	function isEntryPoint();

	/**
	 * isEndPoint 
	 * 
	 * @access public
	 * @return void
	 */
	function isEndPoint();
}