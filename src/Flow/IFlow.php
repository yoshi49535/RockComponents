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

namespace Rock\Components\Flow;

// <Use>
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\State\IFlowState;


/**
 *
 */
interface IFlow
{
    /**
     *
     */
	public function handle(IInput $request, IFlowState $state = null);

}
