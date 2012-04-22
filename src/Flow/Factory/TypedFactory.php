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
namespace Rock\Components\Flow\Factory;

// 
use Rock\Components\Flow\Type\IType;
use Rock\Components\Flow\Type\DefaultType;

class TypedFactory extends TemplateFactory
{
	protected $defaultType;
	protected $types = array();

	public function __construct()
	{
		parent::__construct();

		$this->init();
	}
	protected function init()
	{
		$this->defaultType  = new DefaultType();
	}
	public function addType(IType $type)
	{
		$this->types[]  = $type;
	}
	public function getType($name)
	{
		foreach($this->types as $type)
		{
			if($type->isType($name))
			{
				return $type;
			}
		}
		return $this->defaultType;
	}
	public function createBuilder($type = null)
	{
		if(!$type)
		{
			$builder  = parent::createBuilder();
		}
		else
		{
			if(is_string($type))
			{
				$type = $this->getType($type);
			}
			$builder = $type->getBuilder($this);
		}
		
		return $builder;
	}
}
