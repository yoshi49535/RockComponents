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

// <Interface>
use Rock\Component\Flow\IFlow;

// <Use> : Flow Component
use Rock\Component\Flow\Traversal\ITraversalState;
use Rock\Component\Flow\Traversal\TraversalState;
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Output\Output;
use Rock\Component\Flow\Path\IPath;

// <Use> : Exceptions
use Rock\Component\Flow\Exception\TraversalStateException;
use Rock\Component\Flow\Exception\FlowHandleException;
use Rock\Component\Flow\Exception\InitializeException;
// @use Deleggate Interface
use Rock\Component\Flow\Delegate\IStateDelegate;

/**
 * Class "Flow" is the abstract base class of Flow Strategy.
 * To use the Flow instance, see Graph Flow which implemented the FlowStrategy w
 * with DirectionalGraph.
 */
abstract class Flow 
  implements
	IFlow
{

	/**
	 * #var IPath
	 */
	protected $path;

	/**
	 *
	 */
	public function __construct()
	{
		$this->path      = null;
	}

	/**
	 * doInit
	 * 
	 */
	protected function doInit(ITraversalState $traversal)
	{
	}
	/**
	 * doInitPath
	 * 
	 */
	protected function doInitPath()
	{
		throw new NotImplementedException('Flow is abstracted. Make sure your extended Flow has onInitPath Function to handle "doInitPath()".');
	}
	/**
	 * doShutdown
	 * 
	 */
	protected function doShutdown(ITraversalState $traversal)
	{
	}
	/**
	 * doInitTraversal
	 * 
	 */
	protected function doInitTraversal(ITraversalState $traversal)
	{
	}
	/**
	 * doRecoverTraversal
	 * 
	 */
	protected function doRecoverTraversal(ITraversalState $traversal)
	{

	}

	/**
	 *
	 */
	abstract protected function doHandleInput(ITraversalState $traversal);

	/**
	 * Create new Traversal
	 */
	public function createTraversalState()
	{
		return new TraversalState($this);
	}

	/** 
	 * handle
	 *   Handle the Flow Request.
	 *   This is the time to construct, recover, and execute the Flow.
	 *   On the first step, the flow construct the traversals.
	 *   On the second step, the flow recover the traversal from the ITraversalState
	 *   Then, on third, flow modify the traversal for Input.
	 */
	public function handle(IInput $input, ITraversalState $traversal = null)
	{
		try
		{
			if(!$traversal)
			{
				$traversal  = $this->createTraversalState();
			}
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

			// Create Output
			$output   = $this->createOutput();
			$traversal->setOutput($output);

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
			throw new FlowHandleException($this, 'Failed to handle flow.', 0, $ex);
		}
		
		return $output;
	}

	/**
	 *
	 */
	protected function createOutput()
	{
		return new Output();
	}

	/**
	 *
	 */
	public function setPath(IPath $path)
	{
		$this->path  = $path;
	}

	/**
	 *
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

	/**
	 *
	 */
	public function reset(ITraversalState $traversal)
	{
		
	}

	public function setStateDelegator($name, $delegator)
	{
		throw new \Exception('Not Supported');
	}
}
