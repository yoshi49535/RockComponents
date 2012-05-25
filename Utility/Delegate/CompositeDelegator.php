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

class CompositeDelegator 
  implements
    IDelegator
{
	/**
	 * children 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $children;

	/**
	 * __construct 
	 * 
	 * @param array $delegators 
	 * @access public
	 * @return void
	 */
	public function __construct($delegators = array())
	{
		$this->children = array();

		// 
		if($delegators && is_array($delegators))
			$this->add($delegators);
	}

	/**
	 * delegate 
	 * 
	 * @param array $args 
	 * @param mixed $invoker 
	 * @access public
	 * @return void
	 */
	public function delegate(array $args = array(), $invoker = null)
	{
		foreach($this->children as $child)
			$child->delegate($args, $invoker);
	}

	/**
	 * __invoke 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __invoke()
	{
		$args     = func_get_args();

		$this->delegate($args);
	}

	/**
	 * add 
	 * 
	 * @param mixed $delegator 
	 * @access public
	 * @return void
	 */
	public function add($delegator)
	{
		if($delegator instanceof IDelegator)
		{
			$this->children[]  = $delegator;
		}
		else if(is_array($delegator))
		{
			foreach($delegator as $child)
				$this->add($child);
		}
	}

	public function delete($delegator)
	{
		if(($delegator instanceof IDelegator) && ($index = in_array($this->children, $delegator)))
			unset($this->children[$index]);
			
			
	}
}
