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
namespace Rock\Comopnent\Utility\Delegate;

class ClosureDelegator extends Delegator
{
	protected $closure;

	public function __construct(\Closure $closure)
	{
		$this->closure = $closure;
	}


	protected function getCallback()
	{
		return $this->closure;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf('ClosureDelegator');
	}
}
