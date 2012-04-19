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

namespace Rock\Componets\Container\Graph\Path;

// <Use>
use Rock\Componets\Container\Graph\IGraph;
use Rock\Componets\Container\Graph\IGraphComponent;
use Rock\Componets\Container\Vector;

class Path
  implements
  	IPath,
    \IteratorAggregate,
	\Countable,
	\Serializable
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

	/**
	 *
	 */
	public function getTrail()
	{
		return $this->getComponents();
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

	/**
	 *
	 */
	public function serialize()
	{
		//return serialize($this->components);
		$data  = array();

		foreach($this->components as $key => $component)
		{
			$data[$key]  = $this->graph->serializeComponentReference($component);
		}
		return serialize($data);
	}

	/**
	 *
	 */
	public function unserialize($data)
	{
		$components = unserialize($data);

		$this->components  = array();
		foreach($components as $key => $component)
		{
			$this->components[$key]   = $this->graph->unserializeComponentReference($component);
		}
	}
}
