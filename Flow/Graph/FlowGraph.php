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

// <Namespace>
namespace Rock\Component\Flow\Graph;
// @extends
use Rock\Component\Automaton\Graph\AutomatonGraph;
// <Use> : Flow Component
use Rock\Component\Flow\IFlow;
use Rock\Component\Flow\Path\IPath as IFlowPath;
use Rock\Component\Flow\Step\IStep as IFlowStep;

use Rock\Component\Flow\Input\IInput as IFlowInput;
use Rock\Component\Flow\Input\Parameters as FlowInputParameters;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Flow\Directions;
use Rock\Component\Automaton\Input\IInput as IAutomatonInput;

/**
 *
 */
class FlowGraph extends AutomatonGraph
{

	//public function getEntrySteps()
	//{
	//	$root  = $this->getRoot();
	//	return $this->getOutboundVertices($root);
	//}

	//public function getNextSteps(IFlowStep $step)
	//{
	//	if(!$step instanceof IVertex)
	//	{
	//		throw new InvalidArgumentException('$step has to be an instance of IVertex.');
	//	}

	//	return $this->getOutbundVertices($step);
	//}

	//public function getPrevSteps(IFlowStep $step)
	//{
	//	if(!$step instanceof IVertex)
	//	{
	//		throw new InvalidArgumentException('$step has to be an instance of IVertex.');
	//	}

	//	return $this->getInbundVertices($step);
	//}
	/**
	 *
	 * @param 
	 * @param  
	 */
	public function handle(IFlowInput $input = null, IState $begin = null)
	{
		//
		$repeatTime = $input->has(FlowInputParameters::REPEAT_TIME) 
			? $input->get(FlowInputParameters::REPEAT_TIME) 
			: FlowInputParameters::REPEAT_TIME_DEFAULT;

		//  
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

		//
		return $path;
	}

	/**
	 *
	 */
	protected function doUpdateStatePosition(IAutomatonInput $input, IState $begin = null)
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
	public function __toString()
	{
		return sprintf('%s[ size=%d]', get_class($this), $this->countStates());
	}
}
