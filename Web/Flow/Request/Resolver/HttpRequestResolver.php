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

namespace Rock\Component\Web\Flow\Request\Resolver;

// <Interface>
use Rock\Component\Web\Flow\Request\Resolver\IRequestResolver;
// <Use>
use Rock\Component\Web\Flow\Input\Input;
use Rock\Component\Web\Flow\Request\FlowRequests;

/**
 *
 */
abstract class HttpRequestResolver 
  implements
    IRequestResolver
{
	protected $idKey;
	protected $directionKey;
	protected $sessionManager;

	/**
	 *
	 */
	public function __construct()
	{
		$this->idKey       = FlowRequests::FLOW_ID_KEY;
		$this->dirctionKey = FlowRequests::DIRECTION_KEY;
	}
	/**
	 *
	 */
	public function setIdKey($key)
	{
		$this->idKey = $key;
	}
	/**
	 *
	 */
	public function getIdKey()
	{
		return $this->idKey;
	}

	/**
	 *
	 */
	public function getDirection()
	{
	    return FlowRequests::DIRECTION_NEXT;	
	}
	/**
	 *
	 */
	public function setDirectionKey($key)
	{
		$this->directionKey = $key;
	}
	/**
	 *
	 */
	public function getDirectionKey()
	{
		return $this->directionKey;
	}

	/**
	 *
	 */
	public function resolve($inputs = array())
	{
		return new Input($this->getDirection(), $inputs);
	}
}
