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
