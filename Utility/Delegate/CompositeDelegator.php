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

use Rock\Component\Utility\ArrayConverter\IArrayConverter;

class CompositeDelegator 
  implements
    IDelegator
{
	
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $resultStrategy;

	/**
	 * children 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $children;

	/**
	 * __construct 
	 * 
	 * @param array $delegators 
	 * @access public
	 * @return void
	 */
	public function __construct($delegators = array())
	{
		$this->resultStrategy = null;
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
		$result  = null;
		$results = array();
		foreach($this->children as $child)
			$results[] = $child->delegate($args, $invoker);
		
		if($this->resultStrategy)
			$result = $this->resultStrategy->resolve($results);

		return $result;
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

		return $this->delegate($args);
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

	public function setResultStrategy(IArrayConverter $converter)
	{
		$this->resultStrategy = $converter;
	}

	public function __toString()
	{
		$childLogs = array();
		foreach($this->children as $child)
		{
			$childLogs[] = (string)$child;
		}
		return sprintf('CompositeDelegator:{size=%d, children=[%s]}', count($this->children), implode(', ', $childLogs));
	}
}
