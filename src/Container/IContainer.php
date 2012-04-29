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
namespace Rock\Component\Container;
// <Use> : IComponent
use Rock\Component\Container\IComponent;

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
