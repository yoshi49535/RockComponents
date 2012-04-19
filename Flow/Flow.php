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
namespace Rock\Components\Flow;


// <Interface>
use Rock\Components\Flow\IFlow;

// <Use> : Flow Components
use Rock\Components\Flow\State\IFlowState;
use Rock\Components\Flow\State\FlowState;
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\Output\Output;
use Rock\Components\Flow\Path\IPath;

// <Use> : Exceptions
use Rock\Components\Flow\Exception\FlowStateException;
use Rock\Components\Flow\Exception\InitializeException;

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
		$this->path  = null;
	}


	/**
	 * doInit
	 * 
	 */
	public function doInit()
	{
	}
	/**
	 * doInitPath
	 * 
	 */
	public function doInitPath()
	{
		throw new NotImplementedException('Flow is abstracted. Make sure your extended Flow has onInitPath Function to handle "doInitPath()".');
	}
	/**
	 * doShutdown
	 * 
	 */
	public function doShutdown()
	{
	}
	/**
	 * doInitState
	 * 
	 */
	public function doInitState(IFlowState $state)
	{
	}
	/**
	 * doRecoverState
	 * 
	 */
	public function doRecoverState(IFlowState $state)
	{
	}

	/**
	 * Create new State
	 */
	public function createFlowState()
	{
		return new FlowState($this);
	}
	/** 
	 * handle
	 *   Handle the Flow Request.
	 *   This is the time to construct, recover, and execute the Flow.
	 *   On the first step, the flow construct the states.
	 *   On the second step, the flow recover the state from the IFlowState
	 *   Then, on third, flow modify the state for Input.
	 */
	public function handle(IInput $input, IFlowState $state = null)
	{
		try
		{
			if(!$state)
			{
				$state  = $this->createFlowState();
			}
			// Initailzie Flow
			$this->doInit();

			try
			{
				// try recover the state from $state
				$this->doRecoverState($state);
			}
			catch(FlowStateException $ex)
			{
				// Failed to recover $state
			    // Initialize step
			    $this->doInitState($state);
			}

			// handle input 
			$this->doHandleInput($input, $state);

			// Shutdown Flow
			$this->doShutdown($state);
		}
		catch(Exception $ex)
		{
			// Failed on some
			throw $ex;
		}
		
		$class  = $this->getOutputClass();
		$output = new $class($input);
		$output->setState($state);

		return $output;
	}

	protected function getOutputClass()
	{
		return 'Rock\\Components\\Flow\\Output\\GraphOutput';
	}

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

}
