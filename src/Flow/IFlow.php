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

namespace Rock\Component\Flow;

// <Use>
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Traversal\ITraversalState;

/**
 *
 */
interface IFlow
{
    /**
     *
     */
	public function handle(IInput $request, ITraversalState $state = null);

}
