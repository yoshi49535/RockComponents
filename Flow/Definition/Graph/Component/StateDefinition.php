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
namespace Rock\Component\Flow\Definition\Graph\Component;
// @extends 
use Rock\Component\Flow\Definition\Path\Component\PathComponentDefinition;
// @interface
use Rock\Component\Flow\Definition\Path\Component\IStateDefinition;
// @use Call
use Rock\Component\Configuration\Definition\Call;
// @use Definition
use Rock\Component\Configuration\Definition\Definition;

/**
 *
 */
class StateDefinition extends PathComponentDefinition
  implements
    IStateDefinition
{
	/**
	 * __construct 
	 * 
	 * @param mixed $id 
	 * @param array $attributes 
	 * @access public
	 * @return void
	 */
	public function __construct($id, array $attributes = array())
	{
		parent::__construct($id, $attributes);
		$this->class = '\\Rock\\Component\\Flow\\Graph\\Vertex\\State';
	}

	/**
	 * getArguments 
	 * 
	 * @access public
	 * @return void
	 */
	public function getArguments()
	{

		return array(
			$this->getPathDefinition()->getReference(), 
			$this->hasAttribute('name') ? $this->getAttribute('name') : $this->getId(), 
		);
	}

	/**
	 * doConfigurateDefinition 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doConfigurateDefinition()
	{
		$handler = $this->hasAttribute('handler') ? $this->getAttribute('handler') : null;
		//
		if($handler instanceof Definition)
			$handler = $handler->getReference();

		//
		if($handler)
		{
			$this->addCall(
			  new Call(
			  	'setHandler',
				array($handler)
			  )
			);
		}
	}
}
