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
namespace Rock\Component\Flow\Type;

// <Use> : Flow Factory
use Rock\Component\Flow\Factory\IFactory;
/**
 *
 */
class DefaultType 
  implements IType
{
	public function __construct()
	{
		parent::__construct('flow.default');
		$this->class = '\\Rock\\Component\\Flow\\GraphFlow';
	}
}
