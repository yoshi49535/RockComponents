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
namespace Rock\Component\Flow\Input;
// <Base>
use Rock\Component\Automaton\Input\IInput as IBaseInput;

/**
 * Flow Input
 */
interface IInput extends IBaseInput
{
	/**
	 *
	 */
	function getDirection(); 
}
