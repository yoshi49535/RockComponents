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

namespace Rock\Component\Web\Flow\Request\Resolver;
/**
 *
 */
interface IRequestResolver
{
	/**
	 *
	 */
	public function getDirection();
	/**
	 *
	 */
	public function getFlowId();
	/**
	 *
	 */
	public function resolve($inputs = array());
}