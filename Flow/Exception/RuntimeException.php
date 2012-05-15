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
class RuntimeException extends Exception
{
	/**
	 * flow 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $flow;

	/**
	 * __construct 
	 * 
	 * @param IFlow $flow 
	 * @param string $message 
	 * @param int $code 
	 * @param \Exception $previous 
	 * @access public
	 * @return void
	 */
	public function __construct(IFlow $flow, $message = '', $code = 0, \Exception $previous = null)
	{
		// Set Flow Instance
		$this->flow   = $flow;
		// Set Exception Parameters
		parent::__construct($message, $code, $previous);
	}
	
	/**
	 * getFlow 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFlow()
	{
		return $this->flow;
	}
}
