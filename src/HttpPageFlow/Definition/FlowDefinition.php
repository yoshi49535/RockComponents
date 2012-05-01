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
namespace Rock\Component\Http\Flow\Definition;
// @extends
use Rock\Component\Flow\Definition\FlowDefinition as BaseDefinition;

/**
 *
 */
class FlowDefinition extends BaseDefinition
{
	/**
	 *
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		$this->class = '\\Rock\\Component\\Http\\Flow\\PageFlow';
	}
}
