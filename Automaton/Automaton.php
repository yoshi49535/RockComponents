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
// @namespace
namespace Rock\Component\Automaton;
// @interface
use Rock\Component\Automaton\IAutomaton;
// @use Traversal
use Rock\Component\Automaton\Traversal\ITraversal;
use Rock\Component\Automaton\Traversal\Traversal;
// @use Trail
use Rock\Component\Automaton\Trail\Trail;
// @use Graph Components
use Rock\Component\Container\Graph\IDirectedGraph;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Automaton\Condition\Factory\ConditionFactory;
use Rock\Component\Automaton\Input\IInput;
// @use Exception
use Rock\Component\Automaton\Exception as AutomatonException;

/**
 *
 */
abstract class Automaton 
  implements
    IAutomaton
{
	/**
	 * path
	 * 
	 * @var IDirectedGraph
	 * @access protected
	 */
	protected $path;

	/**
	 * __construct 
	 * 
	 * @override
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->path  = null;
	}

	/**
	 * setPath 
	 * 
	 * @param IDirectedGraph $path 
	 * @access public
	 * @return void
	 */
	public function setPath(IDirectedGraph $path)
	{
		$this->path  = $path;
	}

	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * getEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEntryPoint()
	{
		$states = $this->getEntryPoints();
		//
		if(count($states) == 0)
			throw new AutomatonException\InitializeException('Automaton dose not have any EntryPoint.');

		return $states[0];
	}

	/**
	 * getEntryPoints 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEntryPoints()
	{
		$root = $this->getPath()->getRoot();
		// Get edges form root 
		return $this->getPath()->getOutboundVerticesOf($root);
	}

	/**
	 * createTrail 
	 * 
	 * @access public
	 * @return void
	 */
	public function createTrail()
	{
		return new Trail($this->getPath());
	}

	/**
	 * backward 
	 *   Redo
	 * @param ITraversal $traversal 
	 * @access public
	 * @return void
	 */
	public function backward(ITraversal $traversal)
	{
		//
		if(count($traversal->getTrail()) === 0)
		{
			throw new AutomatonException\RuntimeException('Automaton Trail is still 0, thus cannot backward.');
		}

		$traversal->getTrail()->popState();
		
		// 
		return $traversal;
	}

	/**
	 * forward 
	 *   Evaluate the input and if possible forward the state.
	 * 
	 * @param IInput $input 
	 * @param IState $begin 
	 * @access public
	 * @return void
	 */
	public function forward(ITraversal $traversal)
	{
		$begin    = null;

		if(count($traversal->getTrail()) > 0)
			$begin = $traversal->getTrail()->last();

		// Create Output Trail for this execution
		$trail = $this->createTrail();
	
		// Grab edges which sourced from current state pos
		if(!$begin)
		{
			$trail->push($this->getEntryPoint());
		}
		else
		{
			$trail->push($begin);
			foreach($this->getPath()->getEdgesFrom($begin) as $condition)
			{
				if($edge instanceof ICondition)
				{
					if($condition->isValid($traversal->getInput()))
					{
						// Push the trail 
						$trail->push($edge);
						$trail->push($edge->getTarget());
						break;
					}
				}
				else
				{
					$trail->push($edge);
					$trail->push($edge->getTarget());
					break;
				}
			}
		}

		if(count($trail) == 0)
		{
			throw new AutomatonException\RuntimeException(sprintf('Automaton cannot forwarded for input[%s].', $traversal->getInput()));
		}

		// update Traversal 
		$traversal->getTrail()->merge($trail);

		return $traversal;
	}

	/**
	 * createTraversal 
	 *   Create new empty traversal
	 * 
	 * @access public
	 * @return void
	 */
	public function createTraversal()
	{
		return new Traversal($this);
	}
}
