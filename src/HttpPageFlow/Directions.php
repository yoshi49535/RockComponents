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
namespace Rock\Components\Http\Flow;

use Rock\Components\Flow\Directions as BaseDirections;

class Directions extends BaseDirections
{
	const NEXT    = 'forward';
	const PREV    = 'backward';
	const CURRENT = 'stay';

	public function isValid($direction)
	{
		switch($direction)
		{
		case self::PREV:
		case self::NEXT:
		case self::CURRENT:
			return true;
			break;
		default:
			return false;
			break;
		}
	}
}
