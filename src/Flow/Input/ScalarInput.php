<?php
/************************************************************************************
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
 ************************************************************************************/
// <Namespace>
namespace Rock\Components\Flow\Input;
// <Base>
use Rock\Components\Flow\Input\Input;

// <Use> : Flow Components
use Rock\Components\Flow\Directions;

// <Use> : Automaton Components
use Rock\Components\Automaton\Input\ScalarInput as AutomatonScalarInput;

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
