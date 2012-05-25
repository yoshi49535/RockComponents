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
namespace Rock\Component\Utility\Delegate;

class ObjectDelegator extends Delegator
{
	/**
	 * object 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $object;	

	/**
	 * __construct 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function __construct($object)
	{

		if(!is_callable($object))
			throw new \InvalidArgumentException('Object has to be implemented as a Closure or implement with __invoke().');

		$this->object = $object;
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
		return $this->object;
	}

	protected function getMethodOwner()
	{
		return $this->object;
	}
}
