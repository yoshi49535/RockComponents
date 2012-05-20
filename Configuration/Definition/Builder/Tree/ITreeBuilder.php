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
// @namesapce
namespace Rock\Component\Configuration\Definition\Builder\Tree;
// 

/**
 * ITreeBuilder 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ITreeBuilder
{
	/**
	 * buildDefintion 
	 *   Build Definition for Specified Node.
	 * 
	 * @param IDefinitionNode $node 
	 * @access public
	 * @return void
	 */
	function buildDefintion(IDefinitionNode $node);
}
