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

use Rock\Component\Http\Flow\Session\SessionManager;

class TestSessionManager extends SessionManager
{
	protected function doMount(array $sessions)
	{
		printf("Session Saved [count=%d]\n", count($sessions));
	}

	protected function doUnmount()
	{
		printf("Session Removed\n");
	}
}
