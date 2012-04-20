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
// <Interface>
use Rock\Components\Automaton\Input\IInput;

// <use> : Automaton Components
use Rock\Components\Automaton\AutomatonDirections;

class Input 
  implements 
    IInput
{
	protected $direction;

	/**
	 *
	 */
	public function __construct($direction = AutomatonDirections::FORWARD)
	{
		$this->setDirection($direction);
	}

	/**
	 *
	 */
	public function setDirection($direction)
	{
		switch($direction)
		{
		case AutomatonDirections::FORWARD;
			$this->direction  = $direction;
			break;
		default:
			throw new \InvalidArgumentException(sprintf('Direction "%s" is not supported.', (string)$direction));
			break;
		}
	}
	/**
	 *
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 *
	 */
	public function getValue()
	{
		return false;
	}
	/**
	 *
	 */
	public function getScalar()
	{
		if($this instanceof IScalarInput)
		{
			return $this->getValue();
		}

		throw new \Exception('Class "%s" is not IScalarInput.', get_class($this));
	}
}
