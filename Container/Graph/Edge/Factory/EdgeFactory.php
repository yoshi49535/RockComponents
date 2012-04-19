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

namespace Rock\Componets\Container\Graph\Edge\Factory;

// <Interface>
use Rock\Componets\Container\Graph\Edge\Factory\IEdgeFactory;

// <Use> 
use Rock\Componets\Container\Graph\Edge\Edge;
use Rock\Componets\Container\Graph\Vertex\IVertex;

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
