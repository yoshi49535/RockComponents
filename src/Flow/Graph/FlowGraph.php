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
use Rock\Components\Automaton\FiniteAutomaton;

// <Use> : Flow Components
use Rock\Components\Flow\IFlow;
use Rock\Components\Flow\Path\IPath as IFlowPath;
use Rock\Components\Flow\Step\IStep as IFlowStep;

use Rock\Components\Flow\Input\IInput as IFlowInput;
use Rock\Components\Flow\Input\Parameters as FlowInputParameters;

// <Use> : Automaton Components
use Rock\Components\Automaton\State\IState;
use Rock\Components\Flow\Directions;
use Rock\Components\Automaton\Input\IInput as IAutomatonInput;

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
		$repeatTime = $input->has(FlowInputParameters::REPEAT_TIME) 
			? $input->get(FlowInputParameters::REPEAT_TIME) 
			: FlowInputParameters::REPEAT_TIME_DEFAULT;

		if($repeatTime)
		{
			for($i = 0; $i < $repeatTime; $i++)
			{
				$path  = $this->doUpdateStatePosition($input, $begin);
				if(!$path || (count($path) <= 0))
					break;
				$begin = $path->last()->current();
			}
		}
		else
		{
			while($begin && !$begin->isEndPoint())
			{
				$path  = $this->doUpdateStatePosition($input, $begin);
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
		case Directions::NEXT:
			// Forward State
			$path  = $this->forward($input, $begin);
			break;
		default:
			throw new \InvalidArgumentException('Direction is unknown fow %s', (string)$input);
			break;
		}

		return $path;
	}
	/**
	 *
	 */
	public function getSteps()
	{
		return $this->getVertices();
	}
	/**
	 *
	 */
	public function countSteps()
	{
		return $this->countVertices();
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('Graph[%s][size=%d]', get_class($this), $this->countSteps());
	}
}
