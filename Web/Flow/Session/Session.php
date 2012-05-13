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

// <Namespace>
namespace Rock\Component\Web\Flow\Session;

// <Base> : Utility Component
use Rock\Component\Utility\ParameterContainer;
// <Interface>
use Rock\Component\Web\Flow\Session\ISession;

// <Use> : Container Component
use Rock\Component\Container\Graph\Path\IPath as ITrail;

class Session extends ParameterContainer
  implements
    ISession
{
	protected $cleanFunctions = array();
	/**
	 *
	 */
	public function __construct(array $defaults = array())
	{
		$this->setValues($defaults);
	}

	/**
	 *
	 */
	public function addCleanFunction($callable)
	{
		$this->cleanFunctions[]  = $callable;
	}
	/**
	 *
	 */
	public function clean()
	{
		foreach($this->cleanFunctions as $func)
		{
			call_user_func($func);
		}
	}
	/**
	 *
	 */
	public function validate()
	{
		// flow_hash is required.
		if(!isset($this['flow_hash']))
			throw new \Exception('Flow Session required "flow_hash", but not initialized.');

		return true;
	}
}