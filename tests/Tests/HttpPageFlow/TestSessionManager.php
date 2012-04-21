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
namespace Rock\ComponentTests\Tests\HttpPageFlow;

use Rock\Components\Http\Flow\Session\SessionManager;

class TestSessionManager extends SessionManager
{
	protected function doSave(array $sessions)
	{
		printf("Session Saved [count=%d]\n", count($sessions));
	}
}
