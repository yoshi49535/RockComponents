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

// <Use> : Factory
use Rock\Components\Flow\Factory\IFactory;

/**
 *
 */
interface IType
{
	public function isType($name);

	public function getBuilder(IFactory $factory);
}
