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

namespace Rock\Component\Container\Graph\Iterator;

class VertexIterator
  implements 
	IVertexIterator
{
	protected $vertex;
	public function __construct(IVertex $vertex = null)
	{
		$this->vertex = $vertex;
	}
	public function current ()
	{
	}
	public function key ()
	{
	}
	public function next ()
	{
		$this->vertex = $this->vertex->getNext();
	}
	public function rewind ()
	{
		// point to very first vertex in VertexContainer
		$this->vertex = $this->vertex->getGraph()->getVertices()->begin()->getNode();
	}
	public function valid ()
	{
		return !is_null($this->vertex);
	}
}
