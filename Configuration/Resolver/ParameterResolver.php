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

// @namespace 
namespace Rock\Component\Configuration\Resolver;
// @interface
use Rock\Component\Core\Resolver\IResolver;
// @use Container
use Rock\Component\Configuration\Container\IContainer;

/**
 *
 */
class ParameterResolver 
  implements
    IResolver
{
	/**
	 *
	 */
	private $container;

	/**
	 *
	 */
	public function __construct(IContainer $container)
	{
		$this->container = $container;
	}

	public function getContainer()
	{
		return $this->container;
	}
	/**
	 *
	 */
	public function resolve($value)
	{
		if($key = $this->getParameterName($value))
			$value = $this->getContainer()->getParameter($key);

		return $value;
	}

	/**
	 *
	 */
	protected function getParameterName($value)
	{
		$match = array();
		if(is_string($value) && preg_match('/^%(?P<name>.*)%$/', $value, $match))
			return $match['name'];	
		return false;
	}
}

