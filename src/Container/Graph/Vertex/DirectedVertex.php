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

// <Namespace>
namespace Rock\Component\Container\Graph\Vertex;

// <Use>
use Rock\Component\Container\Graph\Vertex\IVertex;
use Rock\Component\Container\Graph\Vertex\Vertex;

class DirectedVertex extends Vertex
{
	
	public function addNext(IVertex $vertex)
	{
		$this->getGraph()->addVertex($vertex);
		$this->getGraph()->addEdgeBetween($this, $vertex);

		return $vertex;
	}
}
