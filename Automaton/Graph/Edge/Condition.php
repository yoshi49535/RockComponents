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
// <Use> : Automaton Component
use Rock\Component\Automaton\Path\State\IState;
use Rock\Component\Automaton\Traversal\ITraversal;
// @use Delegate
use Rock\Component\Utility\Delegate\IDelegator;
use Rock\Component\Utility\Delegate\ObjectDelegator;
use Rock\Component\Utility\Delegate\MethodDelegator;
use Rock\Component\Utility\Delegate\ClosureDelegator;

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
	 * __construct 
	 * 
	 * @param IState $source 
	 * @param IState $target 
	 * @param mixed $validator 
	 * @access public
	 * @return void
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
		$bRet  = $this->validator($traversal);

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
	 * __toString 
	 * 
	 * @access public
	 * @return void
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
