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
// @namespace
namespace Rock\Component\Flow\IO;
// @extends 
use Rock\Component\Automaton\IO\Input as AutomatonInput;
// @interface
use Rock\Component\Flow\IO\IInput;
use Rock\Component\Flow\Util\IParameterBag;
// @use Flow
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
	 * params 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $params;

	/**
	 * direction 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $direction;

	/**
	 * __construct 
	 * 
	 * @override
	 * @param mixed $direction 
	 * @param array $params 
	 * @access public
	 * @return void
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
	 * get 
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function get($idx)
	{
		return $this->params->get($idx);
	}
	/**
	 * set 
	 * 
	 * @param mixed $idx 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($idx, $value)
	{
		$this->params->set($idx, $value);
	}
	/**
	 * has 
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function has($idx)
	{
		return $this->params->has($idx);
	}
	/**
	 * all 
	 * 
	 * @access public
	 * @return void
	 */
	public function all()
	{
		return $this->params->all();
	}

	/**
	 * getParameterBag 
	 * 
	 * @access public
	 * @return void
	 */
	public function getParameterBag()
	{
		return $this->params;
	}

	//
	/**
	 * setDirection 
	 * 
	 * @param string $direction 
	 * @access public
	 * @return void
	 */
	public function setDirection($direction)
	{
		$this->direction  = $direction;
	}
	/**
	 * getDirection 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf("Flow Input[%s] : \n\t[Direction='%s']", get_class($this), (string)$this->direction);
	}
}
