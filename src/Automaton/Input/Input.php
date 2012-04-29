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
namespace Rock\Component\Automaton\Input;
// <Interface>
use Rock\Component\Automaton\Input\IInput;

/**
 *
 */
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
	public function __construct()
	{
		$this->init();
	}

	/**
	 *
	 */
	protected function init()
	{
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
