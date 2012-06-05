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
namespace Rock\Component\Automaton\IO;
// <Base>
use Rock\Component\Automaton\IO\Input;
// <Interface>
use Rock\Component\Automaton\IO\IScalarInput;

// <Use> : Automaton Component
use Rock\Component\Automaton\Directions;

/**
 *
 */
class ScalarInput extends Input
  implements IScalarInput
{
	/**
	 * __construct 
	 * 
	 * @param mixed $value 
	 * @param mixed $direction 
	 * @access public
	 * @return void
	 */
	public function __construct($value, $direction = Directions::FORWARD, $params = array())
	{
		parent::__construct($direction, $params);

		$this->value  = $value;
	}

	/**
	 * setValue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setValue($value)
	{
		$this->value  = $value;
	}

	/**
	 * getValue 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValue()
	{
		return $this->value;
	}
}
