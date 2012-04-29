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
namespace Rock\Component\Automaton;
// <Base>
use Rock\Component\Container\Graph\IDirectedGraph;
// <Use> : Flow IO
use Rock\Component\Automaton\Input\IInput;
// <Use> : Automaton State Vertex
use Rock\Component\Automaton\State\IState;
/**
 *
 */
interface IAutomaton
{
	/**
	 *
	 */
	public function root();

	/**
	 *
	 */
	public function forward(IInput $input = null, IState $begin = null);

	/**
	 *
	 */
	public function isHandleException();
}
