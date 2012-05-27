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
namespace Rock\Component\Automaton\Path\Condition\Validator;
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
