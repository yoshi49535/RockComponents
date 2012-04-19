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

namespace Rock\Componets\Container\Graph;

// <Use>
use Rock\Componets\Container\Graph\Vertex\IVertex;

interface IGraph
{
	public function addVertex(IVertex $vertex);	
	public function addEdge(IVertex $vertex, IVertex $source);

	public function getVertices();
	public function getEdges();
}
