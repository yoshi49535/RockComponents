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
use Rock\Components\Flow\BaseIO;
// <Interface>
use Rock\Components\Flow\Input\IInput;

// <Use> : Flow Components
use Rock\Components\Flow\FlowDirections;
// <Use> : Automaton Components
use Rock\Componets\Automaton\Input\Input as AutomatonInput;

class Input extends BaseIO
  implements
    IInput
{
	protected $direction;

	/**
	 *
	 */
	public function __construct($direction = FlowDirections::FORWARD, array $params = array())
	{
		$this->setDirection($direction);

		parent::__construct($params);
	}

	/**
	 *
	 */
	public function setDirection($direction)
	{
		switch($direction)
		{
		case FlowDirections::FORWARD;
		case FlowDirections::BACKWARD;
		case FlowDirections::STAY;
			$this->direction  = $direction;
			break;
		default:
			$this->direction   = FlowDirections::FORWARD;
			break;
		}
	}
	
	/**
	 *
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 *
	 */
	public function convertToAutomaton()
	{
		return new AutomatonInput(FlowDirections::convertToAutomaton($this->direction));
	}

	public function __toString()
	{
		return sprintf("Flow Input[%s] : \n\t[Direction='%s']", get_class($this), (string)$this->direction);
	}
}
