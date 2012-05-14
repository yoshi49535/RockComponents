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
namespace Rock\Component\Flow\Definition\Path\Component;
// @extend
use Rock\Component\Configuration\Definition\Definition as BaseDefinition;
// @use Path Interface
use Rock\Component\Flow\Definition\Path\IPathDefinition;

// @use Component Reference
use Rock\Component\Configuration\Definition\Reference;

/**
 *
 */
abstract class PathComponentDefinition extends BaseDefinition
  implements
    IPathComponentDefinition
{

	/**
	 * path 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $path;

	/**
	 * getPathDefinition 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPathDefinition()
	{
		return $this->path;
	}

	/**
	 * setPathDefinition 
	 * 
	 * @param IPathDefinition $definition 
	 * @access public
	 * @return void
	 */
	public function setPathDefinition(IPathDefinition $definition)
	{
		$this->path  = $definition;
	}

}
