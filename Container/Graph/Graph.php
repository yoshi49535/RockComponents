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
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Container\IContainer;
// <Use> : Container Component
use Rock\Component\Container\IComponent;
// <Use> : Graph Component
use Rock\Component\Container\Graph\Vertex\IVertex;
use Rock\Component\Container\Graph\Vertex\Vertex;
use Rock\Component\Container\Graph\Edge\IEdge;
use Rock\Component\Container\Graph\Edge\Factory\EdgeFactory;

class Graph
  implements
	IGraph,
	IContainer
{
	
	/**
	 * root 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $root;
	/**
	 *
	 */
	protected $factory;

	/**
	 * 
	 */
	protected $edgeFactory;

	/**
	 *
	 */
	protected $vertices;
	/**
	 *
	 */
	protected $edges;

    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
	{
		$this->root      = new Vertex($this);
		$this->vertices  = array();
		$this->edges     = array();

		$this->initEdgeFactory();
	}

	/**
	 * getRoot 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * countEdges 
	 * 
	 * @access public
	 * @return void
	 */
	public function countEdges()
	{
		return count($this->edges);
	}

	/**
	 * getEdges 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEdges()
	{
		return $this->edges;
	}

	/**
	 *
	 */
	public function countVertices()
	{
		return count($this->vertices);
	}
	/**
	 *
	 */
	public function getVertices()
	{
		return $this->vertices;
	}

	/**
	 *
	 */
	public function addVertex(IVertex $vertex)
	{
		$this->vertices[]  = $vertex;
		$vertex->setGraph($this);
		return $vertex;
	}
	/**
	 *
	 */
	public function addEdge(IEdge $edge)
	{
		$this->edges[]  = $edge;

		return $edge;
	}
	/**
	 *
	 */
	public function addEdgeBetween(IVertex $source, IVertex $target)
	{
		$this->edges[]  = ($edge = $this->getEdgeFactory()->createEdge($source, $target));

		return $edge;
	}


	/**
	 * initEdgeFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initEdgeFactory()
	{
		$this->edgeFactory = new EdgeFactory();
	}
	/**
	 * getEdgeFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEdgeFactory()
	{
		return $this->edgeFactory;
	}

	/**
	 * serializeComponentReference 
	 * 
	 * @param IComponent $component 
	 * @access public
	 * @return void
	 */
	public function serializeComponentReference(IComponent $component)
	{
		if(!($component instanceof IGraphComponent) || ($component->getGraph() != $this))
		{
			throw new \InvalidArgumentException('$component has to be a component of this Graph.');
		}
		if($component instanceof IVertex)
		{
			return array('v', array_search($component, $this->vertices, true));
		}
		else if($component instanceof IEdge)
		{
			return 
				array(
					'e', 
					array_search($component->getSource(),$this->vertices, true), 
					array_search($component->getTarget(), $this->vertices, true)
				);
		}

		throw new \Exception('Unknown Component is given.');
	}
	
	/**
	 * unserializeComponentReference 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function unserializeComponentReference($data)
	{
		switch($data[0])
		{
		case 'v':
		    return $this->vertices[$data[1]];
			break;
		case 'e':
			$src   = $this->vertices[$data[1]];
			$trg   = $this->vertices[$data[2]];
			
			foreach($this->edges as $edge)
			{
				if(($edge->getSource() === $src) && ($edge->getTarget() === $trg))
				{
					return $edge;
				}
			}
			break;
		default:
		    break;
		}
		throw new \Exception('Invalid Component is given.');
	}
}
