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

namespace Rock\Component\Container\Graph\Path;

// <Use>
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Container\Graph\IGraphComponent;
// @use Graph Component Interface
use Rock\Component\Container\Graph\Edge\IEdge;
use Rock\Component\Container\Graph\Vertex\IVertex;

class Path
  implements
  	IPath,
    \IteratorAggregate,
	\Countable
{
	protected $graph;
	protected $components;

	/**
	 * __construct 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	public function __construct(IGraph $graph)
	{
		$this->graph       = $graph;
		$this->components  = array();
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
	 *
	 */
	public function push(IGraphComponent $component)
	{
		$this->components[]  = $component;
	}

	public function pop()
	{
		return array_pop($this->components);
	}

	/**
	 *
	 */
	public function getComponents()
	{
		return $this->components;
	}
	/**
	 *
	 */
	public function & getComponentsByRef()
	{
		return $this->components;
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
	 *
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->components);
	}
	/**
	 *
	 */
	public function count()
	{
		return count($this->components);
	}
	///**
	// *
	// */
	//public function countVertices()
	//{
	//	return count();
	//}
	/**
	 *
	 */
	public function first()
	{
		if(count($this->components) <= 0)
		{
			throw new \Exception('Component is empty');
		}
		$itr = new \ArrayIterator($this->components);
		$itr->rewind();
		return $itr;
	}

	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	public function last()
	{
		if(count($this->components) <= 0)
		{
			throw new \Exception('Component is empty');
		}
		$itr = new \ArrayIterator($this->components);
		$itr->seek(count($this->components) - 1);
		return $itr;
	}

	/**
	 * merge 
	 * 
	 * @param IPath $path 
	 * @access public
	 * @return void
	 */
	public function merge(IPath $path)
	{
		if($path->count() === 0)
		{
			// do not merge any
			return ;
		}
		else if($this->count() === 0)
		{
			// copy all components from path
			$this->components  = $path->getComponents();
		}
		else
		{
			$srcItr  = $path->first();
			$trgItr  = $this->last();

			if(!$srcItr->valid() || !$trgItr->valid())
			{
				throw new \Exception('Invalid state iterator');
			}
			else if($srcItr->current() === $trgItr->current())
			{
				$srcItr->next();
				while($srcItr->valid())
				{
					$this->push($srcItr->current());
					$srcItr->next();
				}
			}
			else
			{
				throw new \InvalidArgumentException('The end component of Source and the first component of Target is difference.' );
			}
		}
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
		foreach($this->components as $key => $component)
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
		$components = $data;

		$this->components  = array();

		foreach($components as $key => $component)
		{
			$this->components[$key]   = $graph->unserializeComponentReference($component);
		}
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
			implode("\n\t", $this->components)
		);
	}
}
