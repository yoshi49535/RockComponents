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

// <Namespace>
namespace Rock\Component\Web\Flow\Traversal;
// <Use>
use Rock\Component\Flow\Traversal\IFlowTraversal;

/**
 * IHttpFlowTraversal 
 * 
 * @uses IFlowTraversal
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IHttpFlowTraversal extends IFlowTraversal
{
	/**
	 * getSession 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSession();
}
