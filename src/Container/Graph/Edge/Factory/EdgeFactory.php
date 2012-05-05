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

namespace Rock\Component\Container\Graph\Edge\Factory;

// <Interface>
use Rock\Component\Container\Graph\Edge\Factory\IEdgeFactory;

// <Use> 
use Rock\Component\Container\Graph\Edge\Edge;
use Rock\Component\Container\Graph\Vertex\IVertex;

/**
 * Default Edge Factory
 */
class EdgeFactory
  implements
    IEdgeFactory
{
	public function createEdge(IVertex $source, IVertex $target)
	{
		return new Edge($source, $target);
	}
}
