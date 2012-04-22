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
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ************************************************************************************/
// <Namespace>
namespace Rock\Components\Http\Flow\Session;

// <Interface>
use Rock\Components\Http\Flow\Session\ISessionManager;

// <Use> : Session
use Rock\Components\Http\Flow\Session\ISession;
use Rock\Components\Http\Flow\Session\Session;

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

		$this->doSave($sessions);
	}

	/**
	 *
	 */
	abstract protected function doSave(array $sessions);

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
			$values[$key]  = $session->getValues();
		}
		return $values;
	}

	/**
	 *
	 */
	protected function getSessionClass()
	{
		return 'Rock\\Components\\Http\\Flow\\Session\\Session';
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
