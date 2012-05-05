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

namespace Rock\Component\Flow\Factory;

// <Interface>
use Rock\Component\Flow\Factory\IFactory;
// <Use> : Flow Component
use Rock\Component\Flow\IFlow;
use Rock\Component\Flow\Builder\Builder;

class Factory
  implements
	IFactory
{
	protected $builderClass;

	public function __construct()
	{
		$this->init();
	}
	protected function init()
	{
		$this->builderClass  = 'Rock\\Component\\Flow\\Buidler\\Builder';
	}
	/**
	 * @param string $name Classname of the flow
	 */
	public function create($name)
	{
		if(!class_exists($name))
		{
			throw new \InvalidArgumentException(sprintf(
				'Flow "%s" dose not exists.',
				$name
			));
		}
			
		$flow  = new $name();
		
		if(!$flow instanceof IFlow)
		{
			throw new \InvalidArgumentException(sprintf(
				'Flow "%s" is not an IFlow instance.',
				get_class($flow)
			));
		}

		return $flow;
	}

	/**
	 *
	 */
	public function createBuilder()
	{
		// Default Builder Class
		$class   = $this->builderClass;

		// Create Builder Instance
		$builder = new $class($this);
		return $builder;
	}
}
