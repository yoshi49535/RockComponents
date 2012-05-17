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
// @namesapce
namespace Rock\Component\Web\Session;
// @use Session Interface
use Rock\Component\Web\Session\ISession;

/**
 * ISessionManager 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ISessionManager
{
	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save();

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key);

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param ISession $session 
	 * @access public
	 * @return void
	 */
	public function set($key, ISession $session);

	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($key);
}
