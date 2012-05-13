<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/
// @namesapce
namespace Rock\Component\Automaton\Graph\Edge;
// <Base>
use Rock\Component\Container\Graph\Edge\Edge;
// <Interface>
use Rock\Component\Automaton\Path\Condition\ICondition;
// <Use> : Automaton Component
use Rock\Component\Automaton\Input\IInput;

/**
 * AnyCondition 
 * 
 * @uses Edge
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class AnyCondition extends Edge
  implements
    ICondition
{
	/**
	 * isValid 
	 * 
	 * @param IInput $cond 
	 * @access public
	 * @return void
	 */
	public function isValid(IInput $cond = null)
	{
		return true;
	}

	/**
	 * getSource 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSource()
	{
		return parent::getSource();
	}

	/**
	 * getTarget 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTarget()
	{
		return parent::getTarget();
	}
}
