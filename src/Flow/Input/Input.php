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

namespace Rock\Components\Flow\Input;

// <Base>
use Rock\Components\Automaton\Input\Input as AutomatonInput;
// <Interface>
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\Util\IParameterBag;
// <Use> : Flow Components
use Rock\Components\Flow\Directions;
// <Use> : ParameterBag
use Rock\Components\Flow\Util\ParameterBag;

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
		$this->params->has($idx);
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
