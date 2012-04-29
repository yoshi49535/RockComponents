<?php
/************************************************************************************
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
 ************************************************************************************/
// <Namespace>
namespace Rock\Component\Http\Flow\Session;

// <Base> : Utility Component
use Rock\Component\Utility\ParameterContainer;
// <Interface>
use Rock\Component\Http\Flow\Session\ISession;

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
