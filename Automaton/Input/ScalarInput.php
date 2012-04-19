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
namespace Rock\Componets\Automaton\Input;
// <Base>
use Rock\Componets\Automaton\Input\Input;
// <Interface>
use Rock\Componets\Automaton\Input\IScalarInput;


/**
 *
 */
class ScalarInput extends Input
  implements IScalarInput
{
	/**
	 *
	 */
	public function __construct($value, $direction = AutomatonDirections::FORWARD)
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
