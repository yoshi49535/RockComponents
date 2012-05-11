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

use Rock\Component\Container\Graph\Vertex\IVertex;

interface IDirectedGraph extends IGraph
{
	public function getInDegreeOf(IVertex $vertex);
	public function getInboundVerticesOf(IVertex $vertex);
	public function getOutDegreeOf(IVertex $vertex);

	public function getOutboundVerticesOf(IVertex $vertex);
}

