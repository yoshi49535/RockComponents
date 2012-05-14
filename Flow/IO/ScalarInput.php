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
use Rock\Component\Flow\Input\Input;

// <Use> : Flow Component
use Rock\Component\Flow\Directions;

// <Use> : Automaton Component
use Rock\Component\Automaton\Input\ScalarInput as AutomatonScalarInput;

class ScalarInput extends Input
{
	protected $value; 

	/**
	 *
	 */
	public function __construct($value, $direction=Directions::CURRENT, $params = array())
	{
		parent::__construct($direction, $params);
		$this->value  = $value;
	}

	/**
	 *
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 *
	 */
	public function setValue($value)
	{
		$this->value  = $value;
	}

	public function __toString()
	{
		return sprintf("Flow Input[%s] : \n\t[Direction='%s']\n\t[value='%s']", get_class($this), (string)$this->direction, (string)$this->value);
	}
}
