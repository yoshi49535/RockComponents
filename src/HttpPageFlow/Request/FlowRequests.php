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
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/
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
