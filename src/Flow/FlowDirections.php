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
use Rock\Components\Automaton\AutomatonDirections;

final class FlowDirections
{
	//
	const FORWARD      = 'forward';
	const BACKWARD     = 'backward';
	const STAY         = 'stay';

	static public function convertToAutomaton($direction)
	{
		switch($direction)
		{
		case self::FORWARD:
			return AutomatonDirections::FORWARD;
			break;
		case self::BACKWARD:
		case self::STAY:
			throw new \InvalidArgumentException(sprintf('Automaton Dose not support Direction "%s"', $direction));
			break;
		}

	}
}
