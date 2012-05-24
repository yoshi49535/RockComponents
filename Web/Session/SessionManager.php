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
namespace Rock\Component\Web\Session;
// <Interface>
use Rock\Component\Web\Session\ISessionManager;
// <Use> : Session
use Rock\Component\Web\Session\ISession;
use Rock\Component\Web\Session\Session;

/**
 * SessionManager 
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class SessionManager
  implements
    ISessionManager,
    \ArrayAccess
{
	protected
	  $sessions   = array();

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		// Initialize Sessions
		$this->sessions = array();
	}
	/**
	 * save 
	 * 
	 * @access public
	 * @return void
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
	 * doMount 
	 * 
	 * @param array $sessions 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doMount(array $sessions);

	/**
	 * doUnmount 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doUnmount();


	public function create($name, $defaults = array())
	{
		$class = $this->getSessionClass();
		$session = new $class($defaults);
		
		$this->set($name, $session);

		return $session;
	}
	/**
	 * offsetGet 
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function offsetGet($idx)
	{
		return $this->get($idx);
	}

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		if(!isset($this->sessions[$key]))
			throw new \Exception(sprintf('Session "%s" is not exists', $key));
		
		return $this->sessions[$key];
	}

	/**
	 *
	 */
	public function offsetSet($idx, $value)
	{
		return $this->set($idx, $value);
	}
	/**
	 *
	 */
	public function set($key, ISession $session)
	{
		$this->sessions[$key] = $session;
		$session->setManager($this);
	}
	
	/**
	 * offsetExists 
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function offsetExists($idx)
	{
		return $this->has($idx);
	}
	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($key)
	{
		return isset($this->sessions[$key]);
	}

	/**
	 * getMergedValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMergedValues()
	{
		$values  = array();
		foreach($this->sessions as $key => $session)
		{
			$session->clean();
			$values[$key]  = $session->all();
		}
		return $values;
	}

	/**
	 * getSessionClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getSessionClass()
	{
		return 'Rock\\Component\\Web\\Session\\Session';
	}

	/**
	 * remove 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function remove($name)
	{
		unset($this[$name]);
	}
	/**
	 * removeSession 
	 * 
	 * @param ISession $sesion 
	 * @access public
	 * @return void
	 */
	public function removeSession(ISession $session)
	{
		$index = in_array($session, $this->sessions);

		unset($this->sessions[$index]);
	}

	/**
	 * offsetUnset
	 * 
	 * @param mixed $idx 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($idx)
	{
		if(isset($this->sessions[$idx]))
			unset($this->sessions[$idx]);
	}
}
