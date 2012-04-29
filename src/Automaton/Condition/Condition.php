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
use Rock\Component\Automaton\Condition\Validator\Validator as ConditionalValidator;
use Rock\Component\Automaton\Condition\Validator\IValidator as IConditionalValidator;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Automaton\Input\IInput;
use Rock\Component\Automaton\Input\ScalarInput;

class Condition extends AnyCondition
{
	protected $condition;

	/**
	 *
	 */
	public function __construct(IState $source, IState $target, $condition = null)
	{
		parent::__construct($source, $target);

		$this->setValidator($condition);
	}

	/**
	 *
	 */
	public function setValidator($condition)
	{
		// For Array Type Callback, and Closure
		if(is_callable($condition))
		{
			$this->condition = new ConditionalValidator($condition);
		}
		else
		{
			$this->condition = $condition;
		}
	}

	/**
	 *
	 */
	public function isValid(IInput $input = null)
	{
		$bRet  = null;

		if(is_null($this->condition))
		{
			$bRet  = parent::isValid($input);
		}
		else
		{
		    if(is_callable($this->condition))
			{
		    	$bRet  = call_user_func($this->condition, $input);
			}
			else if($this->condition instanceof IConditionValidator)
			{
				$bRet  = $this->condition($input);
			}
		    else if($input instanceof ScalarInput)
			{
		    	$bRet  = ($this->condition == $input->getValue());
			}
			else
			{
				throw new \Exception(get_class($this->condition));
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
		  //$this->condition,
		  $this->source, 
		  $this->target);
	}
}
