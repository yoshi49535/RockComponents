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

namespace Rock\Component\Container\Graph\Vertex;

// <Interface>
use Rock\Component\Container\Graph\Vertex\INamedVetex
class NamedVertex extends Vertex
  implements 
    INamedVertex
{
	protected $name;

	public function __construct($name)
	{
		$this->name  = $name;
	}
	/**
	 *
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 *
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name="%s"]', get_class($this), $this->getName());
	}
}