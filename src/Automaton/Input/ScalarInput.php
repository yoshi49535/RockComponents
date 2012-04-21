<?php
/**
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 */
// <Namespace>
namespace Rock\Components\Automaton\Input;
// <Base>
use Rock\Components\Automaton\Input\Input;
// <Interface>
use Rock\Components\Automaton\Input\IScalarInput;

// <Use> : Automaton Components
use Rock\Components\Automaton\Directions;


/**
 *
 */
class ScalarInput extends Input
  implements IScalarInput
{
	/**
	 *
	 */
	public function __construct($value, $direction = Directions::FORWARD)
	{
		parent::__construct($direction);

		$this->value  = $value;
	}

	/**
	 *
	 */
	public function setValue($value)
	{
		$this->value  = $value;
	}

	/**
	 *
	 */
	public function getValue()
	{
		return $this->value;
	}
}
