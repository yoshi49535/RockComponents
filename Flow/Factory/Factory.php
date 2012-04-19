<?php
/************************************************************************************
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/

namespace Rock\Components\Flow\Factory;

// <Interface>
use Rock\Components\Flow\Factory\IFactory;
// <Use> : Flow Components
use Rock\Components\Flow\IFlow;

class Factory
  implements
	IFactory
{
	public function __construct()
	{
		$this->init();
	}
	protected function init()
	{
	}
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
}
