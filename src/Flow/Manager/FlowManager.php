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

namespace Rock\Component\Flow\Manager;

// <Interface>
use Rock\Component\Flow\Manager\IFlowManager;
// <Use>
use Rock\Component\Flow\IFlow;
use Rock\Component\Flow\INamedFlow;
use Rock\Component\Flow\Exception\FlowNotExistsException;


class FlowManager implements IFlowManager
{
	protected $flows;

	/**
	 *
	 */
	public function __construct()
	{
		// Recovery the previous flow 
		$this->flows = array();
	}
	
	/**
	 *
	 */
	public function has($name)
	{
		return array_key_exists($name, $this->flows);
	}
	/**
	 *
	 */
	public function get($name)
	{
		if(array_key_exists($name, $this->flows))
		{
			return $this->flows[$name];
		}

		throw new FlowNotExistsException($name);
	}
	/**
	 *
	 */
	public function set($name, IFlow $flow)
	{
		//
		$this->flows[$name]  = $flow;
	}
}
