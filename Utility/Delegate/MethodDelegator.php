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
namespace Rock\Component\Utility\Delegate;

class MethodDelegator extends Delegator
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $owner;
	/**
	 * method 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $method;
	/**
	 * __construct 
	 * 
	 * @param mixed $object 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function __construct($object, $method)
	{
		$this->owner = $object;
		if(!is_string($method))
			throw new \InvalidArgumentException('$method has to be a string.');
		$this->method= $method;
	}
	/**
	 * getCallable 
	 * 
	 * @abstract
	 * @access protected
	 * @return mixed
	 */
	protected function getCallback()
	{
		return array($this->owner, $this->method);
	}

	/**
	 * getMethodOwner 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getMethodOwner()
	{
		return $this->owner;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf('MethodDelegator:{object:"%s", method:"%s"}', get_class($this->owner), $this->method);
	}
}
