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
// <Namespace>
namespace Rock\Component\Flow\Type;
// <Use> : Factory
use Rock\Component\Flow\Factory\IFactory;

abstract class Types 
  implements IType
{
	/**
	 * 
	 * @return array Array which contains Type as Key and Class as Value
	 */
	public function getFlowTemplates()
	{
		return array();
	}

	/**
	 * @return Types 
	 */
	public function getTypes()
	{
		return array_keys($this->getFlowTemplates);
	}
	
	/** 
	 *
	 */
	public function getBuilderClass()
	{
		return 'Rock\\Component\\Flow\\Builder\\Builder';
	}

	/**
	 *
	 */
	public function isSupport($name)
	{
		return in_array($name, $this->getTypes());
	}
}
