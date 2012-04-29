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

/**
 *
 */
interface IContainer
{
	function set($id, $value);
	function get($id);

	function getDefinitions();
	function getDefinition($id);
}
