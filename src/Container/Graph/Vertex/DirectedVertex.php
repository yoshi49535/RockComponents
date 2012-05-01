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
