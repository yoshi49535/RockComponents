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

namespace Rock\Component\Container\Graph\Edge;

// <Interface>
use Rock\Component\Container\Graph\Edge\IEdge;
// <Use>
use Rock\Component\Container\Graph\Vertex\IVertex;

/**
 *
 */
class Edge 
  implements
    IEdge
{
	protected $source;
	protected $target;

	public function __construct(IVertex $source, IVertex $target)
	{
		$this->source  = $source;
		$this->target  = $target;
	}

	public function getSource()
	{
		return $this->source;
	}
	public function getTarget()
	{
		return $this->target;
	}

	public function __toString()
	{
		return sprintf("Graph Edge[%s]:\n\t[src=%s] -> [trg%s]",get_class($this), $this->source, $this->target);
	}
	public function getGraph()
	{
		return $this->source->getGraph();
	}
}
