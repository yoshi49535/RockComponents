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
namespace Rock\Component\Web\Flow\Type;
// @extend
use Rock\Component\Flow\Type\BaseType as BaseTypeBase;
// @use Call
use Rock\Component\Configuration\Definition\Call;

/**
 *
 */
abstract class BaseType extends BaseTypeBase
{
	protected $defaultPageClass;
	public function __construct($id)
	{
		parent::__construct($id);
		
		$this->class = '\\Rock\\Component\\Web\\Flow\\PageFlow';
		$this->defaultPageClass    = '\\Rock\\Component\\Web\\Flow\\Definition\\PageDefinition';
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
		$class       = $this->defaultPageClass;
		$definition  = new $class($this->generateSubId($name));
		$definition->setAttribute('name', $name);
		
		if($callback)
			$definition->addCall(new Call('setHandler', array($callback)));
	
		$this->addStateDefinition($definition);
		return $this;
	}

}
