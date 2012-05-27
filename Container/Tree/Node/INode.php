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
namespace Rock\Component\Container\Tree\Node;
//
use Rock\Component\Container\Tree\ITree;

/**
 * INode
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface INode
{
	/**
	 * getTree 
	 * 
	 * @access public
	 * @return void
	 */
	function getTree();

	/**
	 * setParent 
	 * 
	 * @param INode $parent 
	 * @access public
	 * @return void
	 */
	function setParent(INode $parent);
	/**
	 * getParent 
	 * 
	 * @access public
	 * @return void
	 */
	function getParent();

	/**
	 * hasNextSibling 
	 * 
	 * @access public
	 * @return void
	 */
	function hasNextSibling();
	/**
	 * setNextSibling 
	 * 
	 * @param INode $node 
	 * @access public
	 * @return void
	 */
	function setNextSibling(INode $node);
	/**
	 * getNextSibling 
	 * 
	 * @access public
	 * @return void
	 */
	function getNextSibling();

	/**
	 * hasPrevSibling 
	 * 
	 * @access public
	 * @return void
	 */
	function hasPrevSibling();
	/**
	 * setPrevSibling 
	 * 
	 * @param INode $node 
	 * @access public
	 * @return void
	 */
	function setPrevSibling(INode $node);
	/**
	 * getPrevSibling 
	 * 
	 * @access public
	 * @return void
	 */
	function getPrevSibling();

	/**
	 * hasChildren 
	 * 
	 * @access public
	 * @return void
	 */
	function hasChildren();
	/**
	 * countChildren 
	 * 
	 * @access public
	 * @return void
	 */
	function countChildren();
	/**
	 * addChild 
	 * 
	 * @param INode $node 
	 * @access public
	 * @return void
	 */
	function addChild(INode $node);
	function getFirstChild(); 
	/**
	 * getChildren 
	 * 
	 * @access public
	 * @return void
	 */
	function getChildren();
}

