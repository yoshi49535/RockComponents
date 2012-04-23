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

namespace Rock\Components\Automaton;

class Directions
  implements
    IDirectionValidator
{
	const FORWARD   = 'forward';

	/**
	 *
	 */
	public function isValid($direction)
	{
		if($direction === self::FORWARD)
		{
			return true;
		}
		return false;
	}
}
