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

use Rock\Component\Flow\IO\IInput as IFlowInput;
use Rock\Component\Flow\IO\Parameters as FlowInputParameters;

// <Use> : Automaton Component
use Rock\Component\Automaton\State\IState;
use Rock\Component\Flow\Directions;
use Rock\Component\Automaton\IO\IInput as IAutomatonInput;

/**
 *
 */
class FlowGraph extends AutomatonGraph
{
	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('%s[ size=%d]', get_class($this), $this->countStates());
	}
}
