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
namespace Rock\Components\Container\Graph;

// <Use>
use Rock\Components\Container\Graph\Vertex\IVertex;

class DirectedGraph extends Graph
  implements
    IDirectedGraph
{
	/**
	 *
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
	 *
	 */
	public function getInbountVerticesOf(IVertex $vertex)
	{
		$vertices  = array();
		foreach($this->getEdgesTo($vertex) as $edge)
		{
			$vertices[]  = $edge->getSource();
		}
		return $vertices;
	}
	/**
	 *
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
	 *
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
	 *
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
	 *
	 */
	public function getOutbountVertices(IVertex $vertex)
	{
		$vertices  = array();
		foreach($this->getEdgesFrom($vertex) as $edge)
		{
			$vertices[]  =  $edge->getTarget();
		}
		return $vertices;
	}
}
