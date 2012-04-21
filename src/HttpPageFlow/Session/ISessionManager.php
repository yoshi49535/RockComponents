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

// <Use>
use Rock\Components\Http\Flow\Session\ISession;

interface ISessionManager
{
	public function save();

	public function get($key);

	public function set($key, ISession $session);

	public function has($key);
}
