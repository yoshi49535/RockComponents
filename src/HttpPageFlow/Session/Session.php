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
namespace Rock\Components\Http\Flow\Session;

// <Base> : Utility Components
use Rock\Components\Utility\ParameterContainer;
// <Interface>
use Rock\Components\Http\Flow\Session\ISession;

// <Use> : Container Components
use Rock\Components\Container\Graph\Path\IPath as ITrail;

class Session extends ParameterContainer
  implements
    ISession
{
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
	public function saveTrail(ITrail $trail = null)
	{
		if(is_null($trail))
		{
			$this['trail'] = null;
		}
		else
		{
			$this['trail'] = $trail->serialize();
		}
	}

	/**
	 *
	 */
	public function recoverTrail(ITrail $trail)
	{
		if(isset($this['trail']))
			$trail->unserialize($this['trail']);
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

