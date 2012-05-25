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
namespace Rock\Component\Configuration\Definition\Provider;

use Rock\Component\Configuration\Container\IContainer;

/**
 * IDefinitionProvider 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IDefinitionProvider
{
	/**
	 * getDefinitions 
	 * 
	 * @access public
	 * @return void
	 */
	function getDefinitions();

	/**
	 * setContainer 
	 * 
	 * @param IContainer $container 
	 * @access public
	 * @return void
	 */
	function setContainer(IContainer $container);

	/**
	 * getContainer 
	 * 
	 * @access public
	 * @return void
	 */
	function getContainer();
}
