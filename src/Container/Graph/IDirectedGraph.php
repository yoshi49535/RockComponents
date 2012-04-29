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

namespace Rock\Component\Container\Graph;

use Rock\Component\Container\Graph\Vertex\IVertex;

interface IDirectedGraph extends IGraph
{
	public function getInDegreeOf(IVertex $vertex);
	public function getInboundVerticesOf(IVertex $vertex);
	public function getOutDegreeOf(IVertex $vertex);

	public function getOutboundVerticesOf(IVertex $vertex);
}

