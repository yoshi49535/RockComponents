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
namespace Rock\Component\Http\Flow\Type;
// @extend
use Rock\Component\Flow\Type\BaseType as BaseTypeBase;

/**
 *
 */
abstract class BaseType extends BaseTypeBase
{
	public function __construct($id)
	{
		parent::__construct($id);
		
		$this->class = '\\Rock\\Component\\Http\\Flow\\PageFlow';
		$this->defaultStateClass      = '\\Rock\\Component\\Http\\Flow\\Definition\\PageDefinition';
	}

	// Shortcut functions
	/**
	 * @alias Rock\Component\Flow\Type\BaseType::addState
	 * @param string $name
	 * @param array $callback
	 * @return self
	 */
	public function addPage($name, $callback = null)
	{
		return $this->addState($name, $callback);
	}
}
