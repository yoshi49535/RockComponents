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

// <Use>
use Rock\Component\Container\Graph\Vertex\IVertex;

class DirectedGraph extends Graph
  implements
    IDirectedGraph
{
	/**
	 * getInDegreeOf 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getInDegreeOf(IVertex $vertex)
	{
		$count = 0;
		foreach($this->getEdges() as $edge)
		{
			if($edge->getTarget() === $vertex)
			{
				$count++;
			}
		}
		return $count;
	}

	/**
	 * getInboundVerticesOf 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getInboundVerticesOf(IVertex $vertex)
	{
		$vertices  = array();
		foreach($this->getEdgesTo($vertex) as $edge)
		{
			$vertices[]  = $edge->getSource();
		}
		return $vertices;
	}

	/**
	 * getEdgesTo 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getEdgesTo(IVertex $vertex)
	{
		$edges  = array();
		foreach($this->getEdges() as $edge)
		{
			if($edge->getTarget() === $vertex)
			{
				$edges[] = $edge;
			}
		}
		return $edges;
	}

	/**
	 * getOutDegreeOf 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getOutDegreeOf(IVertex $vertex)
	{
		$count = 0;
		foreach($this->getEdges() as $edge)
		{
			if($edge->getSource() === $vertex)
			{
				$count++;
			}
		}
		return $count;
	}

	/**
	 * getEdgesFrom 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getEdgesFrom(IVertex $vertex)
	{
		$edges  = array();
		foreach($this->getEdges() as $edge)
		{
			if($edge->getSource() === $vertex)
			{
				$edges[] = $edge;
			}
		}
		return $edges;
	}

	/**
	 * getOutboundVerticesOf 
	 * 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function getOutboundVerticesOf(IVertex $vertex)
	{
		$vertices  = array();
		foreach($this->getEdgesFrom($vertex) as $edge)
		{
			$vertices[]  =  $edge->getTarget();
		}
		return $vertices;
	}

	/**
	 * getVerticesBetween 
	 * 
	 * @param IVertex $from 
	 * @param IVertex $to 
	 * @param array $vertices 
	 * @access public
	 * @return void
	 */
	public function getVerticesBetween(IVertex $from = null, IVertex $to = null, array $vertices = array())
	{
		if($from === null)
			$from = $this->getRoot();

		if($to)
		{
			// Stop Vertices
			if(in_array($to, $vertices))
				return $vertices;
			// Get InboundVertices to $to
			$prevs = $this->getInboundVerticesOf($to);
			foreach($prevs as $prev)
			{
				$vertices  = array_merge($vertices, $this->getVerticesBetween($from, $prev, $vertices));
				$vertices[]  = $prev;
			}
		}
		else
		{
			if(in_array($from, $vertices))
				return $vertices;
			$nexts = $this->getOutboundVerticesOf($from);
			foreach($nexts as $next)
			{
				$vertices = array_merge($vertices, $this->getVerticesBetween($next, $to, $vertices));
				$vertices[] = $next;
			}
		}
		return $vertices;
	}

}
