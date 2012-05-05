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
namespace Rock\Component\Flow;

// <Use> : Automaton Component
use Rock\Component\Flow\Direction\IDirectionResolver;

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
