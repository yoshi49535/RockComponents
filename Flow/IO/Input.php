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
// @use Flow
// <Use> : Flow Component
use Rock\Component\Flow\Directions;

class Input extends AutomatonInput
  implements
    IInput
{
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
	public function __construct($direction, $params = array())
	{
		// 
		parent::__construct($params);

		$this->direction = $direction;
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
