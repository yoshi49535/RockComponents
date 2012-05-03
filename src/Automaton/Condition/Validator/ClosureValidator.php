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

/**
 *
 */
class ClosureValidator 
  implements
    IValidator
{
	protected $closure;
	/**
	 *
	 */
	public function __construct($closure)
	{
		if($closure instanceof Closure)
		{
			$this->closure = $closure;
		}
		else if(is_callable($closure))
		{
			$this->closure = $this->convertToClosure($closure);
		}
		else
		{
			throw new \InvalidArgumentException(sprintf('Constructor of Validator only accept callable value, but "%s" given.', $closure));
		}


		// 
		$reflection = new \ReflectionFunction($this->closure);
		if($reflection->getNumberOfParameters() !== 1)
		{
			throw new \InvalidArgumentException('The API of Validator Callback must only accept one parameter[IInput] for call.');
		}

	}
	/**
	 *
	 */
	public function convertToClosure($closure)
	{
		return function($cond) use ($closure){
			return call_user_func($closure, $cond);
		};
	}
	/**
	 *
	 */
	public function __invoke(IInput $input)
	{
		return call_user_func($this->closure, $input);
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('Condition Validator[%s]', get_class($this));
	}
}
