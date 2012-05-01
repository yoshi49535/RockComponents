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

namespace Rock\Component\Flow\Traversal;

// <Use>
use Rock\Component\Flow\IFlow;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Output\IOutput;

/**
 * Traversal class is a FlowAccessor or Proxy, which provide concealed-access-methods for current TraversalStae.
 */
abstract class TraversalState implements ITraversalState
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
	 *
	 */
	protected $keepAlive;

	/**
	 * @param IFlow
	 */
	public function __construct(IFlow $flow)
	{
		$this->flow  = $flow;
		$this->keepAlive = true;
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
		$this->output->setTraversal($this);
	}

	/**
	 *
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 *
	 */
	public function isKeepAlive()
	{
		return $this->keepAlive;
	}

	/**
	 *
	 */
	public function setKeepAlive($bAlive)
	{
		$this->keepAlive  = $bAlive;
	}

	/**
	 *
	 */
	public function reset()
	{
	}
}
