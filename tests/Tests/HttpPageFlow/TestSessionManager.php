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
