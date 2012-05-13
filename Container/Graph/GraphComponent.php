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

namespace Rock\Component\Container\Graph;

// <Interface>
use Rock\Component\Container\Graph\IGraphComponent;

// <Use>
use Rock\Component\Container\Graph\IGraph;

//class GraphComponent extends ContainerComponent
class GraphComponent
  implements
    IGraphComponent
{
	/**
	 * graph 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $graph;
	
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->graph = null;
	}

	/**
	 * getGraph 
	 * 
	 * @access public
	 * @return void
	 */
	public function getGraph()
	{
		return $this->graph;
	}

	/**
	 * setGraph 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	public function setGraph(IGraph $graph)
	{
		$this->graph  = $graph;
	}
}
