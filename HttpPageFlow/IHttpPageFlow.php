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
namespace Rock\Component\Http\Flow;
// <Use> : Session Manager
use Rock\Component\Http\Flow\Session\ISessionManager;

/**
 *
 */
interface IHttpPageFlow
{
	public function setSessionManager(ISessionManager $manager);

	public function getSessionManager();
}
