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
namespace Rock\Component\Automaton\IO;
// @use Path Component
use Rock\Component\Automaton\Path\Trail\ITrail;

/**
 * IOutput 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IOutput
{
	/**
	 * setTrail 
	 * 
	 * @param ITrail $trail 
	 * @access public
	 * @return void
	 */
	function setTrail(ITrail $trail);

	/**
	 * getTrail 
	 * 
	 * @access public
	 * @return void
	 */
	function getTrail();
}
