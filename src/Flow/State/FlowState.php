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

namespace Rock\Components\Flow\State;

// <Use>
use Rock\Components\Flow\IFlow;
// <Use> : Flow IO
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\Output\IOutput;

/**
 * State class is a FlowAccessor or Proxy, which provide concealed-access-methods for current Flow State.
 */
abstract class FlowState implements IFlowState
{
	/**
	 * @var IFlow
	 */
	protected $flow;
	/**
	 * @var IInput
	 */
	protected $input;
	/**
	 * @var IOutput
	 */
	protected $output;

	/**
	 * @param IFlow
	 */
	public function __construct(IFlow $flow)
	{
		$this->flow  = $flow;
	}

	/**
	 *
	 */
	public function getFlow()
	{
		return $this->flow;
	}

	/**
	 *
	 */
	public function setInput(IInput $input)
	{
		$this->input  = $input;
	}
	/**
	 *
	 */
	public function getInput()
	{
		return $this->input;
	}

	/**
	 *
	 */
	public function setOutput(IOutput $output)
	{
		$this->output  = $output;
		$this->output->setState($this);
	}

	/**
	 *
	 */
	public function getOutput()
	{
		return $this->output;
	}
}
