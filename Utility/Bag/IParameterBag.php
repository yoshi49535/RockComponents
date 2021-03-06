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
// @namesapce
namespace Rock\Component\Utility\Bag;

/**
 * IParameterBag 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IParameterBag
{
	/**
	 *
	 */
	public function get($idx);

	/**
	 *
	 */
	public function set($idx, $value);

	/**
	 *
	 */
	public function all();
	
	/**
	 *
	 */
	public function has($idx);
}
