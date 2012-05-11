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
