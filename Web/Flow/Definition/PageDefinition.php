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

// @namespace
namespace Rock\Component\Web\Flow\Definition;
// @extends
use Rock\Component\Flow\Definition\StateDefinition;

/**
 *
 */
class PageDefinition extends StateDefinition
{
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = '\\Rock\\Component\\Web\\Flow\\Page';
	}
}
