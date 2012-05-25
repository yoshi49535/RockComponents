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

namespace Rock\Component\Flow;
// @extends
use Rock\Component\Automaton\FiniteAutomaton;

// <Interface>
use Rock\Component\Flow\IFlow;

// <Use> : Flow Component
use Rock\Component\Automaton\Traversal\ITraversal;
use Rock\Component\Flow\Traversal\Traversal;
use Rock\Component\Flow\IO\IInput;

// <Use> : Exceptions
use Rock\Component\Flow\Exception\TraversalStateException;
use Rock\Component\Flow\Exception\HandleException;
use Rock\Component\Flow\Exception\InitializeException;

/**
 * Flow 
 * 
 * @uses FiniteAutomaton
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Flow extends FiniteAutomaton 
  implements
	IFlow
{
	/**
	 * initWithAttribute 
	 * 
	 * @param array $attributes 
	 * @access public
	 * @return void
	 */
	public function initWithAttributes($attributes = array())
	{

	}

	/**
	 * doInit 
	 * 
	 * @param ITraversal $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doInit(ITraversal $traversal)
	{
	}

	/**
	 * doShutdown 
	 * 
	 * @param ITraversal $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doShutdown(ITraversal $traversal)
	{
	}

	/**
	 * doInitTraversal 
	 * 
	 * @param ITraversal $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doInitTraversal(ITraversal $traversal)
	{
	}

	/**
	 * doRecoverTraversal 
	 * 
	 * @param ITraversal $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doRecoverTraversal(ITraversal $traversal)
	{
		throw new TraversalStateException('Flow dose not have recovery strategy.');
	}

	/**
	 * doHandleInput 
	 * 
	 * @param ITraversal $traversal 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	protected function doHandleInput(ITraversal $traversal)
	{
		try
		{
			switch($traversal->getInput()->getDirection())
			{
			case Directions::NEXT:
				$this->forward($traversal);
				break;
			case Directions::PREV:
				$this->backward($traversal);
				break;
			// CURRENT
			default:
				$this->stay($traversal);
				break;
			}

			// 
			$traversal->getOutput()->success();
		}
		catch(\Exception $ex)
		{
			$traversal->getOutput()->fail();
			throw $ex;
		}
	}

	/**
	 * stay 
	 * 
	 * @param ITraversal $traversal 
	 * @access public
	 * @return void
	 */
	public function stay(ITraversal $traversal)
	{
		$current = $traversal->getTrail()->last()->current();
		if($traversal->hasInput())
			$current->handle($traversal);

		// 
		$trail = $this->getPath()->createTrail();
		$trail->push($current);
		$traversal->getOutput()->setTrail($trail);

		return $traversal;
	}

	public function forward(ITraversal $traversal)
	{
		parent::forward($traversal);

		// Execute Last State
		$current = $traversal->getOutput()->getTrail()->last()->current();
		if($traversal->hasInput())
			$current->handle($traversal);
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

	/** 
	 * handle
	 *   Handle the Flow Request.
	 *   This is the time to construct, recover, and execute the Flow.
	 *   On the first step, the flow construct the traversals.
	 *   On the second step, the flow recover the traversal from the ITraversal
	 *   Then, on third, flow modify the traversal for Input.
	 */
	public function handle(IInput $input, ITraversal $traversal = null)
	{
		$exception = null;
		try
		{
			if(!$traversal)
				$traversal  = $this->createTraversal();

			$traversal->setInput($input);

			// Initailzie Flow
			$this->doInit($traversal);

			try
			{
				// try recover the traversal from $traversal
				$this->doRecoverTraversal($traversal);
			}
			catch(TraversalStateException $ex)
			{
				// Failed to recover $traversal
			    // Initialize step
			    $this->doInitTraversal($traversal);
			}
			// handle input 
			$this->doHandleInput($traversal);
		}
		catch (FlowRuntimeExeption $ex)
		{
			$traversal->getOutput()->fail();

			$exception = $ex;
		}
		catch (\Exception $ex)
		{
			$traversal->getOutput()->fail();
			// Failed on some
			$exception = new HandleException($this, 'Failed to handle flow.', 0, $ex);
		}

		// Shutdown Flow
		$this->doShutdown($traversal);

		if($exception)
			throw $exception;
		
		return $traversal->getOutput();
	}

	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPath()
	{
		if(!$this->path)
		{
			throw new InitializeException('Failed to initialize Flow Path.');
		}
		return $this->path;
	}

}
