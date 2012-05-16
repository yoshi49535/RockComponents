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
namespace Rock\Component\Web\Flow;
// <Use> : Session
use Rock\Component\Web\Session\ISession;

/**
 * IHttpFlow 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IHttpFlow
{
	/**
	 * setSession 
	 * 
	 * @param ISession $manager 
	 * @access public
	 * @return void
	 */
	function setSession(ISession $manager);

	/**
	 * getSession
	 * 
	 * @access public
	 * @return void
	 */
	function getSession();
}
