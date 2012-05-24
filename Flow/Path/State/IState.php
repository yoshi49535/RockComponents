<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
//
namespace Rock\Component\Flow\Path\State;
//
use Rock\Component\Automaton\Path\State\IState as IBaseState;
// 
use Rock\Component\Flow\Traversal\IFlowTraversal;

/**
 * IState 
 * 
 * @uses IBaseState
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IState extends IBaseState
{
	/**
	 * handle 
	 * 
	 * @param IFlowTraversal $traversal 
	 * @access public
	 * @return void
	 */
	function handle(IFlowTraversal $traversal);
}

