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
namespace Rock\Component\Automaton\Path\Trail;
// @use Path Component Interface
use Rock\Component\Automaton\Path\IComponent as IPathComponent;

/**
 * ITrail 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ITrail
{
	/**
	 * push 
	 * 
	 * @param IPathCompnent $path 
	 * @access public
	 * @return void
	 */
	function push(IPathComponent $path);

	/**
	 * pop 
	 * 
	 * @access public
	 * @return void
	 */
	function pop();

	/**
	 * first 
	 * 
	 * @access public
	 * @return void
	 */
	function first();

	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	function last();

	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	function getPath();

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	function serialize();

	/**
	 * unserialize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function unserialize($data);
}
