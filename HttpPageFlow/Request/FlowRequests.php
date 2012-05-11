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

namespace Rock\Component\Http\Flow\Request;

use Rock\Component\Http\Flow\Direction;

final class FlowRequests
{
	const FLOW_ID_KEY         = 'fkey';
	const DIRECTION_KEY       = 'direction';

	//
	const DIRECTION_NEXT      = 'next';
	const DIRECTION_PREVIOUS  = 'prev';
	const DIRECTION_CURRENT   = 'current';

}
