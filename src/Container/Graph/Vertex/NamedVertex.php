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
