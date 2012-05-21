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
// @namespace
namespace Rock\Component\Container\Graph\Edge;
// @interface
use Rock\Component\Container\INamedComponent;
// @use
use Rock\Component\Container\Graph\Vertex\IVertex;


/**
 * Edge 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class NamedEdge extends Edge 
  implements
    INamedComponent
{
	/**
	 * name 
	 * 
	 * @var string
	 * @access protected
	 */
	protected $name;
	/**
	 * __construct 
	 * 
	 * @param IVertex $source 
	 * @param IVertex $target 
	 * @access public
	 * @return void
	 */
	public function __construct($name, IVertex $source, IVertex $target)
	{
		parent::__construct($source, $target);
		$this->name  = $name;
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
}

