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
// @namesapce
namespace Rock\Component\Container\Tree\Node;

class ScalarNode extends Node
//  implements
//    IScalar
{
	private $scalar;

	public function __construct($scalar)
	{
		$this->scalar  = $scalar;
	}
	public function getScalar()
	{
		return $this->scalar;
	}
}
