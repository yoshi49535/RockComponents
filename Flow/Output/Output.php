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

namespace Rock\Components\Flow\Output;

// <Use>
use Rock\Components\Flow\BaseIO;
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\State\IFlowState;

class Output extends BaseIO
  implements 
    IOutput
{
	protected $input;
	protected $state;

	public function __construct(IInput $input , $params = array())
	{
		parent::__construct($params);

		$this->input = $input;
		$this->state = null;
	}

	
	/**
	 * Get related input
	 */
	public function getInput()
	{
		return $this->input;
	}

	/**
	 *
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 *
	 */
	public function setState(IFlowState $state)
	{
		$this->state  = $state;
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf("Flow Output:[Class='%s']", get_class($this));
	}
}
