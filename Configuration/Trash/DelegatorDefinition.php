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
namespace Rock\Component\Configuration\Definition;

class DelegatorDefinition extends Definition
{
	public function __construct($id, $attributes = array())
	{
		parent::__construct($id, $attributes);

		//$this->class = 'Rock\\Component\\Utility\\Delegate\\Delegator';
	}
}

