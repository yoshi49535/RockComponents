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

// <use> : Direction 
use Rock\Components\Automaton\Directions;
use Rock\Components\Automaton\IDirectionValidator;

class Input 
  implements 
    IInput
{
	/**
	 *
	 */
	protected $validator;

	/**
	 *
	 */
	protected $direction;

	/**
	 *
	 */
	public function __construct($direction = Directions::FORWARD)
	{
		$this->init();

		$this->setDirection($direction);
	}

	/**
	 *
	 */
	protected function init()
	{
		$this->setDirectionValidator(new Directions());
	}

	public function setDirectionValidator(IDirectionValidator $validator)
	{
		$this->validator = $validator;
	}
	public function getDirectionValidator()
	{
		return $this->validator;
	}
	/**
	 *
	 */
	public function setDirection($direction)
	{
		if(($validator = $this->getDirectionValidator()) && !$validator->isValid($direction))
		{
			throw new \InvalidArgumentException(sprintf('Direction "%s" is not supported.', (string)$direction));
		}
		$this->direction  = $direction;
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
