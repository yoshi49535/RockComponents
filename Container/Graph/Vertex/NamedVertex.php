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
namespace Rock\Component\Container\Graph\Vertex;
// @interface
use Rock\Component\Container\INamedComponent;

/**
 * NamedVertex 
 * 
 * @uses Vertex
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class NamedVertex extends Vertex
  implements 
    INamedComponent
{
	protected $name;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
		parent::__construct();
		$this->name  = $name;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name="%s"]', get_class($this), $this->getName());
	}
}
