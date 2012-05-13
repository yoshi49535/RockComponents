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
// @use
use Rock\Component\Utility\Delegate\IDelegator;


/**
 * Delegate 
 * 
 * @final
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Delegate
{
	/**
	 * holder 
	 *   Delegator Holder
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $delegateOwner;

	/**
	 * delegator 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $callback;

	/**
	 * __construct 
	 * 
	 * @param mixed $holder 
	 * @access public
	 * @return void
	 */
	public function __construct($callback, $invoker = null)
	{
		//
		$this->callback = $callback;
		$this->delegateOwner = $invoker;
		
	}

	/**
	 * __invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function __invoke()
	{
		$ret  = null;

		// Validate Callback method
		if(!is_callable($this->callback))
		{
			throw new \Exception(sprintf(
				"Invalid Callback method is registed into Delegate.\n%s", 
				\Rock\Component\Debug\Variable::dump($this->callback)
			));
		}

		// prepare call 
		$args    = func_get_args();
		$originalOwner  = null;

		if($this->isDelegatorDelegate())
		{
			$originalOwner = $this->getDelegator()->getInvoker();
			$this->getDelegator()->setInvoker($this->delegateOwner);
		}

		// Call registed callback
		$ret = call_user_func_array($this->callback, $args);

		if($this->isDelegatorDelegate())
		{
			$this->getDelegator()->setInvoler($originalOwner);
		}


		return $ret;
	}

	/**
	 * isDelegatorDelegate 
	 * 
	 * @access public
	 * @return void
	 */
	public function isDelegatorDelegate()
	{
		return ($this->callback && is_array($this->callback) && ($this->callback[0] instanceof IDelegator));
	}

	/**
	 * getDelegator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegator()
	{
		$delegator = null;

		if($this->isDelegatorDelegate())
			$delegator = $this->callback[0];

		return $delegator;
	}
}
