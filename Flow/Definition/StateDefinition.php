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
namespace Rock\Component\Flow\Definition;
// @extend

// @use Call
use Rock\Component\Configuration\Definition\Call;

/**
 *
 */
class StateDefinition extends FlowComponentDefinition
{
	/**
	 *
	 */
	public function __construct($id, array $attributes = array())
	{
		parent::__construct($id, $attributes);
		$this->class = '\\Rock\\Component\\Flow\\Graph\\State\\State';
	}

	/**
	 *
	 */
	public function getArguments()
	{
		return array(
			$this->getGraphDefinition()->getReference(), 
			$this->hasAttribute('name') ? $this->getAttribute('name') : $this->getId(), 
			$this->hasAttribute('handler') ? $this->getAttribute('handler') : null
		);
	}

	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		if($this->hasAttribute('handler'))
		{
			$this->addCall(
			  new Call(
			  	'setHandler',
				array($this->getAttribute('handler'))
			  )
			);
		}
	}
}
