<?php
/****
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
 ****/
// @namespace
namespace Rock\Component\Automaton\Condition\Validator;
// @use Input Interface
use Rock\Component\Automaton\Input\IInput;
use Rock\Component\Automaton\Input\IScalarInput;

/**
 *
 */
class ScalarCompareValidator
  implements
    IValidator
{
	const EQUAL = 'equal'; 
	protected $comparizon;
	protected $compare;

	public function __construct($compare, $comparizon = self::EQUAL)
	{
		$this->compare    = $compare;
		$this->comparizon = $comparizon;
	}

	public function isValid($value)
	{
		$bValid  = false;
		switch($this->comparizon)
		{
		case self::EQUAL:
		default:
			$bValid = ($this->comparizon == $value);
			break;
		}

		return $bValid;
	}

	public function __invoke(IInput $input)
	{
		if($input instanceof IScalarInput)
		{
			return $this->isValid($input->getValue());
		}
		return false;
	}
}
