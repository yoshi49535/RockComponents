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
namespace Rock\Component\Container\Graph\Path;
// @extends
use Rock\Component\Container\Misc\Path\AbstractPath;

// <Use>
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Container\Graph\IGraphComponent;
// @use Graph Component Interface
use Rock\Component\Container\Graph\Edge\IEdge;
use Rock\Component\Container\Graph\Vertex\IVertex;

/**
 * Path 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Path extends AbstractPath
  implements
  	IPath
{
	/**
	 * __construct 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	public function __construct(IGraph $graph)
	{
		parent::__construct($graph);
	}

	/**
	 * getGraph 
	 * 
	 * @access public
	 * @return void
	 */
	public function getGraph()
	{
		return $this->getContainer();
	}
	/**
	 *
	 */
	public function push(IGraphComponent $component)
	{
		$this->pushComponent($component);
	}

	public function pop()
	{
		return $this->popComponent();
	}

	/**
	 *
	 */
	public function getVertices()
	{
		$vertices   = array();
		$components = $this->getComponents();

		foreach($components as $component)
		{
			if($component instanceof IVertex)
				$vertices[]  = $component;
		}

		return $vertices;
	}
	/**
	 *
	 */
	public function getEdges()
	{
		$components = $this->getComponents();

		foreach($components as $component)
		{
			if($component instanceof IVertex)
				$vertices[]  = $component;
		}

		return $vertices;
	}

	/**
	 * pack 
	 * 
	 * @access public
	 * @return void
	 */
	public function pack()
	{
		//return serialize($this->components);
		$data  = array();

		if(!$graph = $this->getGraph())
		{
			throw new \Exception('Graph for Path is not initialized.');
		}
		foreach($this->getComponents() as $key => $component)
		{
			$data[$key]  = $graph->serializeComponentReference($component);
		}
		return $data;
	}

	/**
	 * unpack 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function unpack(array $data = array())
	{
		if(!$graph = $this->getGraph())
		{
			throw new \Exception('Graph for Path is not initialized.');
		}
		$components = array();

		foreach($data as $key => $component)
		{
			$components[$key]   = $graph->unserializeComponentReference($component);
		}

		$this->setComponents($components);
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf(
			"Graph Path[%s][count=%d]\n\t%s",
			get_class($this),
			$this->count(),
			implode("\n\t", $this->getComponents())
		);
	}
}
