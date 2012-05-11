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

// <Namespace>
namespace Rock\Component\Web\Flow\Session;

// <Interface>
use Rock\Component\Web\Flow\Session\ISessionManager;

// <Use> : Session
use Rock\Component\Web\Flow\Session\ISession;
use Rock\Component\Web\Flow\Session\Session;

abstract class SessionManager
  implements
    ISessionManager,
    \ArrayAccess
{
	protected
	  $sessions   = array();

	public function load()
	{
		// Initialize Sessions
		$this->sessions = array();
	}
	/**
	 *
	 */
	public function save()
	{
		$sessions = $this->getMergedValues();

		if(empty($sessions))
			$this->doUnmount();
		else
			$this->doMount($sessions);
	}

	/**
	 *
	 */
	abstract protected function doMount(array $sessions);
	/**
	 *
	 */
	abstract protected function doUnmount();

	/**
	 *
	 */
	public function offsetGet($idx)
	{
		return $this->get($idx);
	}

	/**
	 *
	 */
	public function get($key)
	{
		if(!isset($this->sessions[$key]))
		{
			$this->sessions[$key] = $this->createSession(array('flow_hash' => $key ));
		}
		
		return $this->sessions[$key];
	}

	/**
	 *
	 */
	public function offsetSet($idx, $value)
	{
		return $this->get($idx, $value);
	}
	/**
	 *
	 */
	public function set($key, ISession $session)
	{
		$this->sessions[$key] = $session;
	}
	
	/**
	 *
	 */
	public function offsetExists($idx)
	{
		return $this->has($idx);
	}
	/**
	 *
	 */
	public function has($key)
	{
		return isset($this->sessions[$key]);
	}

	/**
	 *
	 */
	public function getMergedValues()
	{
		$values  = array();
		foreach($this->sessions as $key => $session)
		{
			$session->clean();
			$values[$key]  = $session->getValues();
		}
		return $values;
	}

	/**
	 *
	 */
	protected function getSessionClass()
	{
		return 'Rock\\Component\\Web\\Flow\\Session\\Session';
	}

	public function remove($name)
	{
		unset($this[$name]);
	}
	/**
	 *
	 */
	public function offsetUnset($idx)
	{
		if(isset($this->sessions[$idx]))
			unset($this->sessions[$idx]);
	}

	protected function createSession(array $defaults = array())
	{
		// create new Session
		return new Session($defaults);
	}
}
