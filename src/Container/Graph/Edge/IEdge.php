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

// <Base>
use Rock\Component\Container\Graph\IGraphComponent;
interface IEdge extends IGraphComponent
{
	/**
	 * @return Rock\ContainerBundle\Graph\Vertex\IVertex
	 */
	public function getSource();

	/**
	 * @return Rock\ContainerBundle\Graph\Vertex\IVertex
	 */
	public function getTarget();
}
