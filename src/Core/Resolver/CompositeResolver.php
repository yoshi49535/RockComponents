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
