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
// @use Path Components
use Rock\Component\Automaton\Path\IAutomatonPath;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Automaton\Condition\Factory\ConditionFactory;
use Rock\Component\Automaton\IO\IInput;
use Rock\Component\Automaton\IO\Output;
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
	 * @var IAutomatonPath
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
	 * @param IAutomatonPath $path 
	 * @access public
	 * @return void
	 */
	public function setPath(IAutomatonPath $path)
	{
		$this->path  = $path;
		$this->path->setOwner($this);
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

		$trail = $traversal->getTrail()->popUntilLastState();
		$traversal->getOutput()->setTrail($trail);
		
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
			$begin = $traversal->getTrail()->last()->current();

		// Create Output Trail for this execution
		$trail = $this->getPath()->createTrail();
	
		// Grab edges which sourced from current state pos
		if(!$begin)
		{
			$trail->push($this->getPath()->getEntryPoint());
		}
		else
		{
			$trail->push($begin);
			$nextConditions = $this->getPath()->getConditionsFrom($begin);
			if(!$nextConditions || empty($nextConditions))
			{
				throw new AutomatonException\RuntimeException('No more states are exists, thus cannot forward.');
			}

			foreach($nextConditions as $condition)
			{
				if($condition instanceof ICondition)
				{
					if($condition->isValid($traversal->getInput()))
					{
						// Push the trail 
						$trail->push($condition);
						$trail->push($condition->getTarget());
						break;
					}
				}
				else
				{
					$trail->push($condition);
					$trail->push($condition->getTarget());
					break;
				}
			}
		}

		if(count($trail) == 0)
		{
			throw new AutomatonException\RuntimeException(sprintf('Automaton cannot forwarded for input[%s].', $traversal->getInput()));
		}

		// Update Output Trail
		$traversal->getOutput()->getTrail()->merge($trail);
		// Update Traversal Trail
		$traversal->getTrail()->merge($trail);

		return $traversal;
	}

	/**
	 * createTraversal 
	 * 
	 * @access public
	 * @return void
	 */
	public function createTraversal()
	{
		return new Traversal($this);
	}
}
