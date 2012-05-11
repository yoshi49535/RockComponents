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

// <Use>
use Rock\Component\Web\Flow\Session\ISession;

interface ISessionManager
{
	public function save();

	public function get($key);

	public function set($key, ISession $session);

	public function has($key);
}
