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

// <Namespace>
namespace Rock\Component\Flow\IO;
// <Base>
use Rock\Component\Automaton\IO\IInput as IBaseInput;

/**
 * IInput 
 * 
 * @uses IBaseInput
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IInput extends IBaseInput
{
	/**
	 * getDirection 
	 *   Alias of getValue. 
	 * @access public
	 * @return void
	 */
	function getDirection();
}
