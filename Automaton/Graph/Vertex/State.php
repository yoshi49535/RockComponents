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
// @interface 
use Rock\Component\Automaton\Path\State\IState;

/**
 * State 
 *  Automaton State as GraphVertex implemented for AutomatonGraphPath
 * 
 * @uses NamedVertex
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
	 * @var mixed
	 * @access protected
	 */
	protected $isEndPoint;

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	protected function init()
	{

	}

	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPath()
	{
		return $this->getGraph();
	}

	/**
	 * asEndPoint 
	 * 
	 * @param mixed $bIs 
	 * @access public
	 * @return void
	 */
	public function asEndPoint($bIs = true)
	{
		$this->isEndPoint = $bIs;
	}

	/**
	 * isEndPoint 
	 * 
	 * @param mixed $isEndPoint 
	 * @access public
	 * @return void
	 */
	public function isEndPoint()
	{
		return (0 === $this->getGraph()->getOutDegreeOf($this)) || $this->isEndPoint;
	}

	/**
	 * asEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function asEntryPoint($bIs = true)
	{
		$this->isEntryPoint  = $bIs;
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
