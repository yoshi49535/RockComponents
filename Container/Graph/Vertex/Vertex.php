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

namespace Rock\Component\Container\Graph\Vertex;

// <BaseClass>
use Rock\Component\Container\Graph\GraphComponent;
// <Interface>
use Rock\Component\Container\Graph\Vertex\IVertex;

class Vertex extends GraphComponent
  implements
	IVertex
{
	public function __toString()
	{
		return sprintf('Graph Vertex[%s]', get_class($this));
	}

}
