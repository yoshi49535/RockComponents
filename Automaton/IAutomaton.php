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
