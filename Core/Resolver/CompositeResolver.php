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

// 
namespace Rock\Component\Core\Resolver;

class CompositeResolver
{
	protected $resolvers;
	public function __construct(array $resolvers = array())
	{
		$this->resolvers  = array();
		$this->addResolvers($resolvers);
	}

	public function addResolvers(array $resolvers)
	{
		foreach($resolvers as $resolver)
		{
			$this->addResolver($resolver);
		}
	}

	public function addResolver(IResolver $resolver)
	{
		$this->resolvers[]  = $resolver;
	}

	public function getResolvers()
	{
		return $this->resolvers;
	}
	public function resolve($value)
	{
		if(is_array($value))
		{
			foreach($value as $k => $v)
			{
				$value[$k]  = $this->resolve($v);
			}
		}
		else
		{
			foreach($this->getResolvers() as $resolver)
			{
				$value  = $resolver->resolve($value);
			}
		}

		return $value;
	}
}
