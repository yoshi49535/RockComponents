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

namespace Rock\Components\Flow;

abstract class BaseIO
{
	protected $params;

	/**
	 *
	 */
	public function __construct(array $params = array())
	{
		$this->params = $params;
	}
	/**
	 *
	 */
	public function setParameters($params)
	{
		$this->params = $params;
	}
	/**
	 *
	 */
	public function getParameters()
	{
		return $this->params;
	}
	/**
	 *
	 */
	public function getParameter($key, $default = null)
	{
		return isset($this->params[$key]) ? $this->params[$key] : $default;
	}
	/**
	 *
	 */
	public function setParameter($key, $value)
	{
		$this->params[$key] = $value;
	}
}
