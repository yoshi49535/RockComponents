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
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/
namespace Rock\Component\Automaton\Condition;

// <Base>
use Rock\Component\Automaton\Condition\AnyCondition;

// <Use> : Automaton Condition
use Rock\Component\Automaton\Condition\Validator\ClosureValidator;
use Rock\Component\Automaton\Condition\Validator\IValidator;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Automaton\Input\IInput;
use Rock\Component\Automaton\Input\ScalarInput;

class Condition extends AnyCondition
{
	protected $validator;

	/**
	 *
	 */
	public function __construct(IState $source, IState $target, $validator = null)
	{
		parent::__construct($source, $target);

		$this->setValidator($validator);
	}

	/**
	 *
	 */
	public function setValidator($validator)
	{
		// For Array Type Callback, and Closure
		if($validator)
		{
			switch($validator)
			{
			case is_object($validator) && ($validator instanceof ClosureValidator):
			case is_array($validator) && is_callable($validator):
				$this->validator = new ClosureValidator($validator);
				break;
			case !is_array($validator) && !is_object($validator):
				$this->validator = new ScalarCompareValidator($validator);
				break;
			default:
				throw new \InvalidArgumentException('Validator is invalid type.');
			}
		}
		else
		{
			$this->validator = null;
		}
	}

	/**
	 *
	 */
	public function isValid(IInput $input = null)
	{
		$bRet  = null;

		if(is_null($this->validator))
		{
			$bRet  = parent::isValid($input);
		}
		else
		{
		    if(is_callable($this->validator))
			{
		    	$bRet  = call_user_func($this->validator, $input);
			}
			else if($this->validator instanceof IValidator)
			{
				$bRet  = $this->validator($input);
			}
		    else if($input instanceof ScalarInput)
			{
		    	$bRet  = ($this->validator == $input->getValue());
			}
			else
			{
				throw new \Exception('Invalid Input Type is given.');
			}
		}

		if(!is_bool($bRet))
		{
			throw new \Exception(sprintf('Condition Validator has to return boolean, but Validator on Condition "%s" returns not bool.', (string)$this));
		}

		return $bRet;
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf(
		  "Graph Edge[%s]:\n\t[src=%s] -> [trg=%s]",
		  get_class($this), 
		  //$this->validator,
		  $this->source, 
		  $this->target);
	}
}
