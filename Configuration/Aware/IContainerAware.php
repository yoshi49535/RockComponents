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
namespace Rock\Component\Configuration\Aware;
// @use Container Interface
use Rock\Component\Configuration\Container\IContainer;

/**
 *
 */
interface IContainerAware
{
	/**
	 *
	 */
	function setContainer(IContainer $container);

	/**
	 *
	 */
	function getContainer();
}
