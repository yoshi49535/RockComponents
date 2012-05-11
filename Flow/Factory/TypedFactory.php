<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/

// <Namespace>
namespace Rock\Component\Flow\Factory;
// <Use> : Type Interface
use Rock\Component\Flow\Type\IType;
use Rock\Component\Flow\Type\DefaultType;
// <Use> : Flow Builder Interface
use Rock\Component\Flow\Builder\IFlowBuilder;

/**
 *
 */
class TypedFactory extends TemplateFactory
{
	/**
	 *
	 */
	protected $types = array();

	/** 
	 * @var
	 */
	protected $defaultTypeClass;

	/** 
	 * @var
	 */
	protected $defaultType;

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->init();
		$this->initDefaultType();
	}

	/**
	 *
	 */
	protected function init()
	{
		$this->defaultTypeClass  = '\\Rock\\Component\\Flow\\Type\\DefaultType';
	}

	/**
	 *
	 */
	protected function initDefaultType()
	{
		$class = $this->defaultTypeClass;
		$this->defaultType  = new $class();
		$this->addType($this->defaultType);
	}
	/**
	 *
	 */
	public function addType(IType $type)
	{
		$this->addTemplates($type->getFlowTemplates());
		$this->types[]  = $type;
	}
	/**
	 *
	 */
	public function getType($name)
	{
		foreach($this->types as $type)
		{
			if($type->isSupport($name))
			{
				return $type;
			}
		}
		return $this->defaultType;
	}
	/**
	 *
	 */
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
			// 
			if(!$type instanceof IType)
			{
				throw new \Exception('Specified Type is not an instanceof IType.');
			}

			$class = $type->getBuilderClass();
		}
		
		$builder = new $class($this);

		if(!$builder instanceof IFlowBuilder)
		{
			throw new \Exception('Builder is not an instanceof IFlowBuilder');
		}

		return $builder;
	}
}
