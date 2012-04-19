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
namespace Rock\Components\Http\Flow\Request\Resolver;

// <Interface>
use Rock\Components\Http\Flow\Request\Resolver\IRequestResolver;
// <Use>
use Rock\Components\Http\Flow\Input\Input;
use Rock\Components\Http\Flow\Request\FlowRequests;
use Rock\OnSymfony\Standard\ComponentExtendBundle\Session\Proxy\ISessionProxyManager;

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
	public function __construct(ISessionProxyManager $manager)
	{
		$this->idKey       = FlowRequests::FLOW_ID_KEY;
		$this->dirctionKey = FlowRequests::DIRECTION_KEY;

		$this->sessionManager = $manager;
	}
	public function getSessionManager()
	{
		return $this->sessionManager;
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
	 * Create new session by SessionManager
	 */
	public function resolveSession()
	{
		return $this->getSessionManager()->createProxy();
	}
	/**
	 *
	 */
	public function resolve($inputs = array())
	{
		return new Input($this->getDirection(), $inputs);
	}
}
