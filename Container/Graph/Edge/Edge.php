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
 * Edge 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Edge 
  implements
    IEdge
{
	/**
	 * source 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $source;
	/**
	 * target 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $target;

	/**
	 * __construct 
	 * 
	 * @param IVertex $source 
	 * @param IVertex $target 
	 * @access public
	 * @return void
	 */
	public function __construct(IVertex $source, IVertex $target)
	{
		$this->source  = $source;
		$this->target  = $target;
	}

	/**
	 * getSource 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSource()
	{
		return $this->source;
	}
	/**
	 * getTarget 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTarget()
	{
		return $this->target;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf("Graph Edge[%s]:\n\t[src=%s] -> [trg%s]",get_class($this), $this->source, $this->target);
	}
	/**
	 * getGraph 
	 * 
	 * @access public
	 * @return void
	 */
	public function getGraph()
	{
		return $this->source->getGraph();
	}
}
