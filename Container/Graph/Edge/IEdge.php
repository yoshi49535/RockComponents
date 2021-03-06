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
// @namesapce
namespace Rock\Component\Container\Graph\Edge;
// @extends 
use Rock\Component\Container\Graph\IGraphComponent;

/**
 * IEdge 
 * 
 * @uses IGraphComponent
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IEdge extends IGraphComponent
{
	/**
	 * getSource 
	 * 
	 * @access public
	 * @return Rock\ContainerBundle\Graph\Vertex\IVertex
	 */
	public function getSource();

	/**
	 * getTarget 
	 * 
	 * @access public
	 * @return Rock\ContainerBundle\Graph\Vertex\IVertex
	 */
	function getTarget();
}
