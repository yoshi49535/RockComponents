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
namespace Rock\Componets\Automaton\Condition;

// <Base>
use Rock\Componets\Automaton\Condition\AnyCondition;

// <Use> : Automaton Condition
use Rock\Componets\Automaton\Condition\Validator as ConditionalValidator;

// <Use> : Automaton Components
use Rock\Componets\Automaton\State\IState;
use Rock\Componets\Automaton\Input\IInput;
use Rock\Componets\Automaton\Input\ScalarInput;

class Condition extends AnyCondition
{
	protected $condition;

	public function __construct(IState $source, IState $target, $condition = null)
	{
		parent::__construct($source, $target);

		$this->setValidator($condition);
	}
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
	public function isValid(IInput $input = null)
	{
		if(is_null($this->condition))
		{
			return parent::isValid($input);
		}
		else
		{
		    if(is_callable($this->condition))
		    {
		    	return (bool)(call_user_func($this->condition, $input));
		    }
		    else if($input instanceof ScalarInput)
		    {
		    	return ($this->condition == $input->getValue());
		    }
		}
	}

	public function __toString()
	{
		return sprintf(
		  "Graph Edge[%s]:\n\t[src=%s] -> [trg%s]",
		  get_class($this), 
		  //$this->condition,
		  $this->source, 
		  $this->target);
	}
}
