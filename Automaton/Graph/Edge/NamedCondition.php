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
// @namesapce
namespace Rock\Component\Automaton\Graph\Edge;
// <Base>
use Rock\Component\Container\Graph\Edge\NamedEdge;
// @interface
use Rock\Component\Automaton\Path\Condition\ICondition;
// <Use> : Automaton Component
use Rock\Component\Automaton\Path\State\IState;
use Rock\Component\Automaton\Traversal\ITraversal;
// @use Delegate
use Rock\Component\Utility\Delegate\IDelegator;
use Rock\Component\Utility\Delegate\ObjectDelegator;
use Rock\Component\Utility\Delegate\MethodDelegator;
use Rock\Component\Utility\Delegate\ClosureDelegator;
use Rock\Component\Utility\Delegate\CompositeDelegator;
use Rock\Component\Utility\ArrayConverter\ArrayToAndBoolConverter;

/**
 * NamedCondition 
 * 
 * @uses NamedEdge
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class NamedCondition extends NamedEdge
  implements
    ICondition
// trail Conditionable
{
	protected $validator;

	/**
	 *
	 */
	public function __construct($name, IState $source, IState $target, $validator = null)
	{
		parent::__construct($name, $source, $target);

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
	 * setValidator 
	 * 
	 * @param mixed $validator 
	 * @access public
	 * @return void
	 */
	public function setValidator($validator)
	{
		$this->validator = $this->convertToDelegator($validator);
	}
	/**
	 * convertToDelegator 
	 * 
	 * @param mixed $callable 
	 * @access protected
	 * @return void
	 */
	protected function convertToDelegator($callable)
	{
		$delegator = null;
		switch(true)
		{
		case (is_array($callable)):
			$delegator = new MethodDelegator($callable[0], $callable[1]);
			break;
		case ($callable instanceof \Closure):
			$delegator = new ClosureDelegator($callable);
			break;
		case ($callable instanceof IDelegator):
			$delegator = $callable;
			break;
		case (is_object($callable) && is_callable($callable)):
			$delegator = new ObjectDelegator($callable);
			break;
		default:
			break;
		}
		return $delegator;
	}

	/**
	 * isValid 
	 * 
	 * @param ITraversal $traversal 
	 * @access public
	 * @return void
	 */
	public function isValid(ITraversal $traversal)
	{
		//
		$bRet = true;
		if($validator = $this->validator)
		{
			if(($validator instanceof CompositeDelegator) && 
			  (null === $validator->getResultStrategy()))
			{
				$validator->setResultStrategy(new ArrayToAndBoolConverter());
			}
			$bRet = $validator($traversal);
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
  
