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
namespace Rock\Component\Automaton\Path\Condition;
// @use Condition Validators
use Rock\Component\Automaton\Path\Condition\Validator;
// @use Delegator Interface
use Rock\Component\Utility\Delegator\IDelegator;

/**
 * ConditionalValidator 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ConditionalValidator
{
	private $validateMethod;

	/**
	 * __construct 
	 * 
	 * @param mixed $validateMethod 
	 * @access public
	 * @return void
	 */
	public function __construct($validateMethod)
	{
		$this->validateMethod = null;
		$this->setValidateMethod($validateMethod);
	}


	/**
	 * setValidateMethod 
	 * 
	 * @param mixed $validateMethod 
	 * @access public
	 * @return void
	 */
	public function setValidateMethod($validateMethod)
	{
		if($validateMethod)
		{
			switch($validateMethod)
			{
			case is_object($validateMethod) && ($validateMethod instanceof Validator\IValidator):
				$this->validateMethod = $validateMethod;
				break;
			case is_array($validateMethod) && is_callable($validateMethod):
				$this->validateMethod = new Validator\ClosureValidator($validateMethod);
				break;
			case !is_array($validateMethod) && !is_object($validateMethod):
				$this->validateMethod = new Validator\ScalarCompareValidator($validateMethod);
				break;
			// For Any Callable or Delegator
			case ($validateMethod instanceof IDelegator):
			case is_callable($validateMethod):
				$this->validateMethod = $validateMethod;
				break;
			default:
				throw new \InvalidArgumentException('Validator is invalid type.');
				break;
			}
		}
		else
		{
			$this->validateMethod = null;
		}
	}

	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate($traversal)
	{
		$bRet  = true;
		if(null !== $this->validateMethod)
		{
			if($this->validateMethod instanceof Validator\IValidator)
			{
				$bRet  = $this->validateMethod($travresal);
			}
		    else if(is_callable($this->validateMethod))
			{
		    	$bRet  = call_user_func($this->validateMethod, $traversal);
			}
			else
			{
				throw new \Exception('Failed on initialize ConditionalValidator.');
			}
		}

		return $bRet;
	}
}
