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
// <Interface>
use Rock\Component\Automaton\IO\IInput;
// extends 
use Rock\Component\Utility\ParameterBagContainer;

/**
 *
 */
class Input extends BaseIO
  implements 
    IInput
{
	public function __construct($params = array())
	{
		parent::__construct($params);
	}
	/**
	 * getValue 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValue()
	{
		return false;
	}

	/**
	 * getScalar 
	 * 
	 * @access public
	 * @return void
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
