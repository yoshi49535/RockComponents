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
