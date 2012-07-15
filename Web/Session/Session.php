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
// @use : Utility Component
use Rock\Component\Utility\ParameterBagContainer;
// <Interface>
use Rock\Component\Web\Session\ISession;
// <Use> : Container Component
use Rock\Component\Container\Graph\Path\IPath as ITrail;

/**
 * Session 
 * 
 * @uses ParameterBagContainer
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Session extends ParameterBagContainer
  implements
    ISession
{
	protected $manager  = null;

	protected $cleanFunctions = array();

	/**
	 * __construct 
	 * 
	 * @param array $defaults 
	 * @access public
	 * @return void
	 */
	public function __construct(array $defaults = array())
	{
		parent::__construct($defaults);
	}

	/**
	 * addCleanFunction 
	 * 
	 * @param mixed $callable 
	 * @access public
	 * @return void
	 */
	public function addCleanFunction($callable)
	{
		$this->cleanFunctions[]  = $callable;
	}

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	public function clean()
	{
		foreach($this->cleanFunctions as $func)
		{
			call_user_func($func);
		}
	}

	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate()
	{
		return true;
	}


	/**
	 * setManager 
	 * 
	 * @param ISessionManager $manager 
	 * @access public
	 * @return void
	 */
	public function setManager(ISessionManager $manager)
	{
		$this->manager  = $manager;
	}
	/**
	 * getManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getManager()
	{
		if(!$this->manager)
			throw new \Exception('SessionManager is not initialized for Session.');
		return $this->manager;
	}
	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
		$this->getManager()->save();
	}

	/**
	 * delete 
	 * 
	 * @access public
	 * @return void
	 */
	public function delete()
	{
		$this->getManager()->removeSession($this);

		$this->getManager()->save();
	}

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	public function reset()
	{
		$this->getParameterBag()->removeAll();
	}
}
