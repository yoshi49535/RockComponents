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
namespace Rock\Component\Automaton\Graph\Vertex;
// @extends
use Rock\Component\Container\Graph\Vertex\Vertex;

/**
 * State 
 * 
 * @uses Vertex
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class State extends Vertex
  implements
    IState
{
	/**
	 * isEntryPoint 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $isEntryPoint;

	/**
	 * isEndPoint 
	 * 
	 * @param mixed $isEndPoint 
	 * @access public
	 * @return void
	 */
	public function isEndPoint($isEndPoint = null)
	{
		return (0 === $this->getGraph()->getOutDegreeOf($this));
	}

	/**
	 * asEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function asEntryPoint()
	{
		$this->isEntryPoint  = true;
		//
		$root = $this->getGraph()->getRoot();
		// 
		$this->getGraph()->addEdge(new Edge($root, $this));
	}

	/**
	 * isEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function isEntryPoint()
	{
		return $this->isEntryPoint;
	}
}
