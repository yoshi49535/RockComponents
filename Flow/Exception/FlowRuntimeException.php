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
namespace Rock\Component\Flow\Exception;
// @use Flow Interface
use Rock\Component\Flow\IFlow;

/**
 *
 */
class FlowRuntimeException extends Exception
  implements
    IFlowException
{
	protected $flow;

	public function __construct(IFlow $flow, $message = '', $code = 0, \Exception $previous = null)
	{
		// Set Flow Instance
		$this->flow   = $flow;
		// Set Exception Parameters
		parent::__construct($message, $code, $previous);
	}
	
	public function getFlow()
	{
		return $this->flow;
	}
}
