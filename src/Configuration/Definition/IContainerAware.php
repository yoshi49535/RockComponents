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
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;

/**
 *
 */
interface IContainerAware
{
	/**
	 *
	 */
	function setContainer(IContainer $container);

	/**
	 *
	 */
	function getContainer();
}
