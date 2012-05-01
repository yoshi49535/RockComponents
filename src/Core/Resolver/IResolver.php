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
namespace Rock\Component\Core\Resolver;

/** 
 *
 */
interface IResolver
{
	/** 
	 * @param mixin 
	 */
	function resolve($value);
}
