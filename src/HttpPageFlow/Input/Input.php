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
namespace Rock\Component\Http\Flow\Input;
// <Base>
use Rock\Component\Flow\Input\Input as BaseInput;
// <Interface> : For Type Safe
use Rock\Component\Http\Flow\Input\IHttpInput;

/**
 *
 */
class Input extends BaseInput
  implements
    IHttpInput
{
	public function setRequestState($name)
	{
		$this->set('request_state', $name);
	}
	public function getRequestState()
	{
		return $this->get('request_state', null);
	}
}
