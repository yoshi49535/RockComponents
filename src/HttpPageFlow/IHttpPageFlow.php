<?php
/****
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
