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
namespace Rock\Component\Flow\Path;
// @extends
use Rock\Component\Automaton\Path\IPathComponent as IAutomatonPathComponent;
// @use 
use Rock\Component\Utility\Delegate\IDelegatorProvider;
use Rock\Component\Utility\Delegate\IDelegator;

/**
 * IPathComponent 
 * 
 * @uses IAutomatonComponent
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPathComponent extends IAutomatonPathComponent
{
	
	/**
	 * addDelegatorWithProvider 
	 * 
	 * @param IDelegatorProvider $provider 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function addDelegatorWithProvider(IDelegatorProvider $provider, $params = array());

	/**
	 * addDelegator 
	 * 
	 * @param IDelegator $delegator 
	 * @access public
	 * @return void
	 */
	function addDelegator(IDelegator $delegator);
	/**
	 * setDelegator 
	 * 
	 * @param IDelegator $delegator 
	 * @access public
	 * @return void
	 */
	function setDelegator(IDelegator $delegator);
}
