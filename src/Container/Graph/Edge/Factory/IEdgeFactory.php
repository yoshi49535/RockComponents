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
namespace Rock\Component\Container\Graph\Edge\Factory;

// <Use>
use Rock\Component\Container\Graph\Vertex\IVertex;

/**
 *
 */
interface IEdgeFactory
{
	/**
	 *
	 * @param $source Rock\ContainerBundle\Graph\Vertex\IVertex
	 * @param $target Rock\ContainerBundle\Graph\Vertex\IVertex
	 * @return Rock\ContainerBundle\Graph\Edge\IEdge
	 */
	public function createEdge(IVertex $source, IVertex $source);
}
