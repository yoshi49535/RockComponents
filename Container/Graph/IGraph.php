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
namespace Rock\Component\Container\Graph;
// @use Graph Vertex
use Rock\Component\Container\Graph\Vertex\IVertex;
// @use Graph Edge
use Rock\Component\Container\Graph\Edge\IEdge;

/**
 *
 */
interface IGraph
{
	/**
	 *
	 */
	function addVertex(IVertex $vertex);	
	/**
	 *
	 */
	function addEdge(IEdge $edge);
	/**
	 *
	 */
	function addEdgeBetween(IVertex $vertex, IVertex $source);

	/**
	 *
	 */
	function getVertices();
	/**
	 *
	 */
	function getEdges();
}
