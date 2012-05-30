<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
namespace Rock\Component\Container\Graph\Vertex;
use Rock\Component\Container\Graph\IGraph;

/**
 * InnerGraphReferenceVertex 
 * 
 * @uses Vertex
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class InnerGraphReferenceVertex extends Vertex
  implements
    IGraphReference
{
	/**
	 * reference 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reference;
	
	public function __construct(IGraph $reference = null)
	{
		$this->reference = $reference;
	}

	/**
	 * getReferencedGraph 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReferencedGraph()
	{
		return $this->reference;
	}

	/**
	 * setReferencedGraph 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	public function setReferencedGraph(IGraph $graph)
	{
		$this->reference = $graph;
	}
}
