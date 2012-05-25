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
namespace Rock\Component\Flow\Path\Condition;
// @extends 
use Rock\Component\Automaton\Path\Condition\ICondition as IAutomatonCondition;
use Rock\Component\Flow\Path\IPathComponent as IFlowPathComponent;


/**
 * ICondition 
 *   Complex interface for Flow Condition
 *
 * @uses IAutomatonCondition
 * @uses 
 * @uses IFlowPathComponent
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface ICondition extends IAutomatonCondition, IFlowPathComponent
{
}
