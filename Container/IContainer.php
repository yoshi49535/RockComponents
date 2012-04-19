<?php
/************************************************************************************
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
 ************************************************************************************/
// <Namespace>
namespace Rock\Components\Container;
// <Use> : IComponent
use Rock\Components\Container\IComponent;

/**
 *
 */
interface IContainer
{
	/**
	 *
	 */
	public function serializeComponentReference(IComponent $component);
	
	/**
	 *
	 */
	public function unserializeComponentReference($data);
}
