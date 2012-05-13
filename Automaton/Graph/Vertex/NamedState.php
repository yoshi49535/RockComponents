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

// <BaseClass>
use Rock\Component\Automaton\State\State;
// <Interface>
use Rock\Component\Container\Graph\Vertex\INamedVertex;
// <Use>
use Rock\Component\Container\Graph\IGraph;

/**
 * NamedState 
 * 
 * @uses State
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class NamedState extends State
  implements
    INamedVertex
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $name;

	/**
	 * __construct 
	 * 
	 * @param IGraph $graph 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct(IGraph $graph, $name)
	{
		parent::__construct($graph);

		$this->name  = $name;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name  = $name;
	}
}
