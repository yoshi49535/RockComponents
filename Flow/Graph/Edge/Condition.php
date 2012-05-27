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
//
namespace Rock\Component\Flow\Graph\Edge;
//
use Rock\Component\Automaton\Graph\Edge\NamedCondition;
// @use 
use Rock\Component\Utility\Delegate\IDelegatorProvider;

/**
 * Condition 
 * 
 * @uses NamedCondition
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Condition extends NamedCondition
{
	/**
	 * setHandler 
	 * 
	 * @param mixed $object 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function initDelegatorWithProvider(IDelegatorProvider $provider, $params = array())
	{
		$params['resultStrategy'] = 'Rock\\Component\\Utility\\ArrayConverter\\ArrayToAndBoolConverter';
		$this->setValidator($provider->createDelegator($params));
	}

	/**
	 * setDelegator 
	 * 
	 * @param IDelegator $delegator 
	 * @access public
	 * @return void
	 */
	public function setDelegator(IDelegator $delegator)
	{
		$this->setValidator($delegator);
	}
	/**
	 * getDelegator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegator()
	{
		return ($this->validator instanceof IDelegator) ? $this->validator : null;
	}
}
