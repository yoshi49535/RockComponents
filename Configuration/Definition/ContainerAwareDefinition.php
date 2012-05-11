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
namespace Rock\Component\Configuration\Definition;

// @interface
use Rock\Component\Configuration\Definition\IContainerAware;
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;


/**
 * ContainerAwareDefinition 
 * 
 * @uses Definition
 * @package 
 * @author Yoshi Aoki <yoshi@44services.jp> 
 */
class ContainerAwareDefinition extends Definition 
  implements
    IContainerAware
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $container;

	/**
	 * getContainer 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContainer()
	{
		if(!$this->container)
		{
			throw new \Exception('Container is not initialized.');
		}
		return $this->container;
	}

	/**
	 * setContainer 
	 * 
	 * @param IContainer $container 
	 * @access public
	 * @return void
	 */
	public function setContainer(IContainer $container)
	{
		$this->container = $container;
	}
}
