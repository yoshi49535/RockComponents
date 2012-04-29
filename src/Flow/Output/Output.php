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
namespace Rock\Component\Flow\Output;
// <Interface>
use Rock\Component\Flow\Util\IParameterBag;
use Rock\Component\Flow\Output\IOutput;

// <Use> : Flow Component
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\State\IFlowState;
// <Use> : ParameterBag
use Rock\Component\Flow\Util\ParameterBag;

class Output 
  implements 
    IOutput,
	IParameterBag
{
	/**
	 *
	 */
	protected $input;
	/**
	 *
	 */
	protected $state;
	/**
	 *
	 */
	protected $params;

	/**
	 *
	 */
	public function __construct($params = array())
	{
		$this->params = new ParameterBag($params);
		$this->state  = null;
	}

	
	/**
	 * Get related input
	 */
	public function getInput()
	{
		return $this->getState()->getInput();
	}

	/**
	 *
	 */
	public function getState()
	{
		if(!$this->state)
			throw new \Exception('State is not initialized, yet.');
		return $this->state;
	}

	/**
	 *
	 */
	public function setState(IFlowState $state)
	{
		$this->state  = $state;
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
	 *
	 */
	public function __toString()
	{
		return sprintf("Flow Output:[Class='%s']", get_class($this));
	}
}
