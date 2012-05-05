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

namespace Rock\Component\Flow;

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
