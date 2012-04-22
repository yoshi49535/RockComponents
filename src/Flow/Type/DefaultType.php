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
namespace Rock\Components\Flow\Type;

// <Use> : Flow Factory
use Rock\Components\Flow\Factory\IFactory;
use Rock\Components\Flow\Builder\Builder;
/**
 *
 */
class DefaultType 
  implements IType
{
	public function isType($name)
	{
		return 'default' === strtolower($name);
	}

	public function getBuilder(IFactory $factory)
	{
		$factory->addTemplate('default', '\\Rock\\Components\\Flow\\GraphFlow');
		return new Builder($factory);
	}
}
