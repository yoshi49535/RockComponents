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
namespace Rock\Components\Http\Flow\Input;
// <Base>
use Rock\Components\Flow\Input\Input as BaseInput;
// <Interface> : For Type Safe
use Rock\Components\Http\Flow\Input\IHttpInput;

use Rock\Components\Http\Flow\Directions;
/**
 *
 */
class Input extends BaseInput
  implements
    IHttpInput
{
	protected function init()
	{
		$this->setDirectionValidator(new Directions());
	}
}
