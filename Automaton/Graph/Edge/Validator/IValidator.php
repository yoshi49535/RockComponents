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

// <Namepsace>
namespace Rock\Component\Automaton\Graph\Edge\Validator;

// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;

interface IValidator
{
	public function __invoke(IInput $input);
}
