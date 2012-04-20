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
namespace Rock\Components\Automaton\Condition;

// <Base>
use Rock\Components\Container\Graph\Edge\IEdge;
// <Use> : Automaton Components
use Rock\Components\Automaton\Input\IInput;

interface ICondition extends IEdge
{
	/**
	 *
	 */
	public function isValid(IInput $cond = null);
}
