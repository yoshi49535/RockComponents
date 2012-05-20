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
namespace Rock\Component\Configuration\Definition\Builder\Tree;

/**
 * IDefinitionNode 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IDefinitionNode
{
	/**
	 * getBuilder 
	 * 
	 * @access public
	 * @return IDefinitionBuilder
	 */
	function getBuilder();
}
