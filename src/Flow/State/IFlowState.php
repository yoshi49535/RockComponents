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

namespace Rock\Components\Flow\State;

interface IFlowState
{
	/**
	 * @return bool Has next on flow or not
	 */
	public function hasPrev();

	/**
	 * @return string Return the URL for prev on flow
	 */
	public function getPrev();

	/**
	 * @return bool Has prev on flow or not
	 */
	public function hasNext();

	/**
	 * @return string Return the URL for next on flow
	 */
	public function getNext();

	/**
	 * @return string Return the URL for current on flow
	 */
	public function getCurrent();

	/**
	 *
	 */
	public function isHandled();
}
