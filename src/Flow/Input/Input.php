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

namespace Rock\Component\Flow\Input;

// <Base>
use Rock\Component\Automaton\Input\Input as AutomatonInput;
// <Interface>
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Util\IParameterBag;
// <Use> : Flow Component
use Rock\Component\Flow\Directions;
// <Use> : ParameterBag
use Rock\Component\Flow\Util\ParameterBag;

class Input extends AutomatonInput
  implements
    IInput,
	IParameterBag
{
	/**
	 *
	 */
	protected $params;

	protected $direction;

	/**
	 * @override
	 */
	public function __construct($direction, array $params = array())
	{
		// 
		parent::__construct();

		$this->direction = $direction;
		$this->params    = new ParameterBag($params);
	}

	// IParameterBag Impl
	/**
	 *
	 */
	public function get($idx)
	{
		return $this->params->get($idx);
	}
	/**
	 *
	 */
	public function set($idx, $value)
	{
		$this->params->set($idx, $value);
	}
	/**
	 *
	 */
	public function has($idx)
	{
		return $this->params->has($idx);
	}
	/**
	 *
	 */
	public function all()
	{
		return $this->params->all();
	}

	/**
	 *
	 */
	public function getParameterBag()
	{
		return $this->params;
	}

	//
	/**
	 * @param string $direction
	 */
	public function setDirection($direction)
	{
		$this->direction  = $direction;
	}
	/**
	 * 
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	//----
	/**
	 *
	 */
	public function __toString()
	{
		return sprintf("Flow Input[%s] : \n\t[Direction='%s']", get_class($this), (string)$this->direction);
	}
}
