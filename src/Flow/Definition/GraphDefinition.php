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
// @namespace
namespace Rock\Component\Flow\Definition;
// @extend
use Rock\Component\Configuration\Definition\Definition;

/**
 *
 */
class GraphDefinition extends Definition
{
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = 'Rock\\Component\\Flow\\Graph\\FlowGraph';
	}
}
