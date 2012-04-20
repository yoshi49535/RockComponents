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

namespace Rock\Components\Container\Graph\Vertex;

// <BaseClass>
use Rock\Components\Container\Graph\GraphComponent;
// <Interface>
use Rock\Components\Container\Graph\Vertex\IVertex;

class Vertex extends GraphComponent
  implements
	IVertex
{
	public function __toString()
	{
		return sprintf('Graph Vertex[%s]', get_class($this));
	}
}
