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

namespace Rock\Components\Container\Graph\Edge;

// <Interface>
use Rock\Components\Container\Graph\Edge\IEdge;
// <Use>
use Rock\Components\Container\Graph\Vertex\IVertex;


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
