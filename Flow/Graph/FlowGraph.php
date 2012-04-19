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

// <Namespace>
namespace Rock\Components\Flow\Graph;

// <Base>
use Rock\Componets\Automaton\FiniteAutomaton;

// <Use> : Flow Components
use Rock\Components\Flow\Flow\IFlow;
use Rock\Components\Flow\Event\FlowEvents;
use Rock\Components\Flow\Event\FlowExecuteEvent;
use Rock\Components\Flow\Flow\Path\IPath as IFlowPath;
use Rock\Components\Flow\Flow\Step\IStep as IFlowStep;

use Rock\Components\Flow\Flow\Input\IInput as IFlowInput;
use Rock\Components\Flow\Flow\Input\Parameters as FlowInputParameters;

// <Use> : Automaton Components
use Rock\Componets\Automaton\State\IState;
use Rock\Componets\Automaton\AutomatonDirections;
use Rock\Componets\Automaton\Input\IInput as IAutomatonInput;

/**
 *
 */
class FlowGraph extends FiniteAutomaton
  implements
    IFlowPath
{
	protected $flow;

	/**
	 *
	 */
	public function __construct(IFlow $flow)
	{
		$this->flow  = $flow;
		parent::__construct();
	}

	/**
	 *
	 */
	public function getDispatcher()
	{
		return $this->getFlow()->getDispatcher();
	}

	/**
	 *
	 */
	public function addStateEvent($name, $listener)
	{
		$this->getDispatcher()->addListener(FlowEvents::flat($name), $listener);
	}

	/**
	 *
	 */
	public function handleState(IState $state, $request)
	{
		//$this->getFlow()->dispatchState($state);
	}

	/**
	 *
	 */
	public function getFlow()
	{
		return $this->flow;
	}

	public function getEntrySteps()
	{
		$root  = $this->getRoot();
		return $this->getOutboundVertices($root);
	}

	public function getNextSteps(IFlowStep $step)
	{
		if(!$step instanceof IVertex)
		{
			throw new InvalidArgumentException('$step has to be an instance of IVertex.');
		}

		return $this->getOutbundVertices($step);
	}

	public function getPrevSteps(IFlowStep $step)
	{
		if(!$step instanceof IVertex)
		{
			throw new InvalidArgumentException('$step has to be an instance of IVertex.');
		}

		return $this->getInbundVertices($step);
	}
	/**
	 *
	 * @param 
	 * @param  
	 */
	public function handle(IFlowInput $input = null, $begin = null)
	{
		$repeatTime = $input->getParameter(FlowInputParameters::REPEAT_TIME, FlowInputParameters::REPEAT_TIME_DEFAULT);
		$graphInput = $input->convertToAutomaton();

		if($repeatTime)
		{
			for($i = 0; $i < $repeatTime; $i++)
			{
				$path  = $this->doUpdateStatePosition($graphInput, $begin);
				if(!$path || (count($path) <= 0))
					break;
				$begin = $path->last()->current();
			}
		}
		else
		{
			while($begin && !$begin->isEndPoint())
			{
				$path  = $this->doUpdateStatePosition($graphInput, $begin);
				if(!$path || (count($path) <= 0))
					break;
				$begin = $path->last()->current();
			}
		}
		return $path;
	}

	/**
	 *
	 */
	protected function doUpdateStatePosition(IAutomatonInput $input, $begin)
	{
		switch($input->getDirection())
		{
		//case FlowDirections::BACKWARD:
		//	$path  = $this->backward($begin);
		//	break;
		case AutomatonDirections::FORWARD:
			// Forward State
			$path  = $this->forward($input, $begin);
			// Handle By State
			if($path && (count($path) > 0))
			{
				$path->last()->current()->handle($input);
			}
			break;
		default:
			throw new \InvalidArgumentException('Direction is unknown fow %s', (string)$input);
			break;
		}

		return $path;
	}
	public function getSteps()
	{
		return $this->getVertices();
	}
	public function countSteps()
	{
		return $this->countVertices();
	}

	public function __toString()
	{
		return sprintf('Graph[%s][size=%d]', get_class($this), $this->countSteps());
	}
}
