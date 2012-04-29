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
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/
// <Namespace>
namespace Rock\Component\Automaton\Condition\Validator;
// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;

class Validator
  implements
    IValidator
{
	protected $callback;
	/**
	 *
	 */
	public function __construct($callback)
	{
		if(!is_callable($callback))
		{
			throw new \InvalidArgumentException(sprintf('Constructor of Validator only accept callable value, but "%s" given.', $callback));
		}
		else if($callback instanceof Closure)
		{
			$this->callback = $callback;
		}
		else
		{
			$this->callback = $this->convertToClosure($callback);
		}


		// 
		$reflection = new \ReflectionFunction($this->callback);
		if($reflection->getNumberOfParameters() !== 1)
		{
			throw new \InvalidArgumentException('The API of Validator Callback must only accept one parameter for call.');
		}

	}
	/**
	 *
	 */
	static public function convertToClosure($callback)
	{
		return function($cond) use ($callback){
			return call_user_func($callback, $cond);
		};
	}
	/**
	 *
	 */
	public function __invoke(IInput $input)
	{
		return call_user_func($this->callback, $input);
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('Condition Validator[%s]', get_class($this));
	}
}
