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

namespace Rock\Component\Container\Graph\Path;

// <Use>
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Container\Graph\IGraphComponent;
use Rock\Component\Container\Vector;

class Path
  implements
  	IPath,
    \IteratorAggregate,
	\Countable
{
	protected $graph;
	protected $components;

	public function __construct(IGraph $graph)
	{
		$this->graph       = $graph;
		$this->components  = array();
	}
	/**
	 *
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
	public function getTrail()
	{
		return $this->getComponent();
	}
	/**
	 *
	 */
	public function getComponent()
	{
		return $this->components;
	}
	/**
	 *
	 */
	public function & getComponentByRef()
	{
		return $this->components;
	}
	/**
	 *
	 */
	public function getVertices()
	{
		$vertices   = array();
		$components = $this->getComponent();

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
		$components = $this->getComponent();

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
	 *
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


	public function merge(IPath $path)
	{
		$srcItr  = $path->first();
		$trgItr  = $this->last();
		if($srcItr->current() === $trgItr->current())
		{
			$srcItr++;	
			while($srcItr)
			{
				if(($srcItr->current() instanceof IEdge) && ($srcItr->current()->getSource() === $trgItr))
				{
					$this->push($srcItr->current());
				}
				else if(($srcItr->current() instanceof IVertex) && ($trgItr->current()->getTarget() === $srcItr->current()))
				{
					$this->push($srcItr->current());
				}
				else
				{
					throw new \Exception('Failed to merge');
				}
				$srcItr++;
				$trgItr++;
			}
		}
	}
	/**
	 *
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
	 *
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

	public function __toString()
	{
		return sprintf(
			"Graph Path[%s] : \n\t[count=%d]",
			get_class($this),
			$this->count()
		);
	}
}
