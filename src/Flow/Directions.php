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

// <Namespace>
namespace Rock\Components\Flow;

// <Use> : Automaton Components
use Rock\Components\Flow\Direction\IDirectionResolver;

/**
 *
 */
class Directions 
{
	// 
	const NEXT         = 'next';
	const PREV         = 'prev';
	const CURRENT      = 'current';
}
