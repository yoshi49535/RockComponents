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
// @namespace
namespace Rock\Component\Flow\Path\State;
// @extends 
use Rock\Component\Automaton\Path\State\IState as IAutomatonState;
use Rock\Component\Flow\Path\IPathComponent as IFlowPathComponent;
// 
use Rock\Component\Flow\Traversal\IFlowTraversal;

/**
 * IState 
 *  Complex interface for Flow State
 * 
 * @uses IBaseState
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IState extends IAutomatonState, IFlowPathComponent
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

