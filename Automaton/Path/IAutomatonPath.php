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
namespace Rock\Component\Automaton\Path;
// @use Automaton Interface
use Rock\Component\Automaton\IAutomaton;
// @use Path Component Interface 
use Rock\Component\Automaton\Path\State\IState;
// @use Path Component Interface 
use Rock\Component\Automaton\Path\Condition\ICondition;

/**
 * IAutomatonPath 
 *  TypeSpecify Interface which extends IDirectedGraph 
 * 
 * @uses IDirectedGraph
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IAutomatonPath
{
	// Owner Accessor
	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	function getOwner();

	/**
	 * setOwner 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	function setOwner(IAutomaton $owner);

	/**
	 * countStates 
	 * 
	 * @access public
	 * @return void
	 */
	function countStates();

	
	/**
	 * addState 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	function addState(IState $state);

	/**
	 * addEntry 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	function addEntry(IState $state);

	/**
	 * getState 
	 * 
	 * @access public
	 * @return void
	 */
	function getState($name);

	/**
	 * addCondition 
	 * 
	 * @param ICondition $condition 
	 * @access public
	 * @return void
	 */
	function addCondition(ICondition $condition);

	/**
	 * getEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	function getEntryPoint();

	/**
	 * getEndPoints 
	 * 
	 * @access public
	 * @return void
	 */
	function getEndPoints();

	/**
	 * getCondtionsFrom 
	 * 
	 * @param IState $IState 
	 * @access public
	 * @return void
	 */
	function getConditionsFrom(IState $state);

	/**
	 * getCondtionsTo 
	 * 
	 * @param IState $IState 
	 * @access public
	 * @return void
	 */
	function getConditionsTo(IState $state);
}
