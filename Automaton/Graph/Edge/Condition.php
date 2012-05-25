<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/
// @namesapce
namespace Rock\Component\Automaton\Graph\Edge;
// @extends 
use Rock\Component\Container\Graph\Edge\Edge;
// @interface
use Rock\Component\Automaton\Path\Condition\ICondition;
// <Use> : Automaton Condition
use Rock\Component\Automaton\Graph\Edge\Validator\ClosureValidator;
use Rock\Component\Automaton\Graph\Edge\Validator\IValidator;
// <Use> : Automaton Component
use Rock\Component\Automaton\Path\State\IState;
use Rock\Component\Automaton\Input\IInput;
use Rock\Component\Automaton\Input\ScalarInput;
// @use Delegate
use Rock\Component\Utility\Delegate\IDelegator;

/**
 * Condition 
 * 
 * @uses Edge
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Condition extends Edge
  implements
    ICondition
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
	 * getSource 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSource()
	{
		return parent::getSource();
	}
	/**
	 * getTarget 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTarget()
	{
		return parent::getTarget();
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
			case ($validator instanceof IDelegator):
				$this->validator = $validator;
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
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPath()
	{
		return $this->getGraph();
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
		  $this->getSource(), 
		  $this->getTarget());
	}
}
