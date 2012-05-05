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

namespace Rock\Component\Flow\Traversal;

interface ITraversalState
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
