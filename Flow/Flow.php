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
use Rock\Component\Flow\IO\Output;

// <Use> : Exceptions
use Rock\Component\Flow\Exception\TraversalException;
use Rock\Component\Flow\Exception\FlowHandleException;
use Rock\Component\Flow\Exception\InitializeException;
// @use Deleggate Interface
use Rock\Component\Utility\Delegate\Delegate;

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
	 * doInitPath 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doInitPath()
	{
		throw new NotImplementedException('Flow is abstracted. Make sure your extended Flow has onInitPath Function to handle "doInitPath()".');
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
		try
		{
			if(!$traversal)
			{
				$traversal  = $this->createTraversal();
			}
			$traversal->setInput($input);

			// Initailzie Flow
			$this->doInit($traversal);

			try
			{
				// try recover the traversal from $traversal
				$this->doRecoverTraversal($traversal);
			}
			catch(TraversalException $ex)
			{
				// Failed to recover $traversal
			    // Initialize step
			    $this->doInitTraversal($traversal);
			}

			// handle input 
			$this->doHandleInput($traversal);

			// Shutdown Flow
			$this->doShutdown($traversal);
		}
		catch (FlowRuntimeExeption $ex)
		{
			throw $ex;
		}
		catch (\Exception $ex)
		{
			// Failed on some
			throw $ex;
			throw new FlowHandleException($this, 'Failed to handle flow.', 0, $ex);
		}
		
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
			//throw new InitializeException('Flow Path has not been constructed, yet.');
			$this->doInitPath();
			if(!$this->path)
			{
				throw new InitializeException('Failed to initialize Flow Path.');
			}
		}
		return $this->path;
	}

	///**
	// * callDelegate 
	// * 
	// * @param mixed $method 
	// * @param mixed $args 
	// * @access public
	// * @return void
	// */
	//public function callDelegate($method, $args)
	//{
	//	$delegate = null;

	//	//
	//	if(!isset($this->delegates[$method]))
	//		throw new \Exception(sprintf('Delegate "%s" is not exists.', $method));

	//	// 
	//	$delegate = $this->delegates[$method];

	//	return call_user_func_array($delegate, $args);
	//}

	///**
	// * setDelegate 
	// * 
	// * @param mixed $name 
	// * @param mixed $callback 
	// * @access public
	// * @return void
	// */
	//public function setDelegate($method, Delegate $callback)
	//{
	//	$this->delegates[$method]  = $callback;
	//}

}
