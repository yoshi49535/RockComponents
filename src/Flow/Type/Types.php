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
namespace Rock\Components\Flow\Type;
// <Use> : Factory
use Rock\Components\Flow\Factory\IFactory;

abstract class Types 
  implements IType
{
	protected $builderClass;
	protected $types;

	public function __construct()
	{
		$this->types = array();

		$this->init();
	}

	abstract protected function init();

	public function getTypes()
	{
		return array_keys($this->types);
	}
	public function getTemplates()
	{
		return $this->types;
	}
	
	protected function getBuilderClass()
	{
		return 'Rock\\Components\\Flow\\Builder\\Builder';
	}

	public function isType($name)
	{
		return in_array($name, $this->getTypes());
	}

	public function getBuilder(IFactory $factory)
	{
		foreach($this->getTemplates() as $key => $class)
			$factory->addTemplate($key, $class);
		
		$class = $this->getBuilderClass();
		return new $class($factory);
	}
}
