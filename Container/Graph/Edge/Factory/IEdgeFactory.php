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
