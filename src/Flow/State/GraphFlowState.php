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
namespace Rock\Components\Flow\State;

// <BaseClass>
use Rock\Components\Flow\State\FlowState;
// <Use>
use Rock\Components\Flow\GraphFlow;
use Rock\Components\Flow\FlowDirection;
use Rock\Components\Container\Graph\Path\IPath as IGraphPath;

/**
 * GraphFlowState is an extended Class of FlowState.
 * This class hold current state in Automaton,
 * the total path to current state,
 * and so on.
 */
class GraphFlowState extends FlowState
{
	/**
	 * The trail from start point to 
	 * 
	 * @var \Rock\Starndard\Container\Graph\Path\Path
	 */
	protected $trail;
	
	/**
	 *
	 */
	public function __construct(GraphFlow $flow, IGraphPath $path = null)
	{
		parent::__construct($flow);

		$this->trail = $path;
	}
	/**
	 *
	 */
	public function getTrail()
	{
		if(!$this->trail)
		{
			// Empty Trail create
			$graph = $this->getFlow()->getPath();
			$this->trail = $graph->createPath();
		}
		return $this->trail;
	}
	/**
	 *
	 */
	public function setTrail(IGraphPath $trail)
	{
		$this->trail = $trail;
	}

	/**
	 * @return bool Has next on flow or not
	 */
	public function hasPrevStep()
	{
		return !$this->getCurrentStep()->isEntryPoint();
	}

	/**
	 * @return string Return the URL for prev on flow
	 */
	public function getPrevStep()
	{
		return null;
	}
	/**
	 * @return bool Has prev on flow or not
	 */
	public function hasNextStep()
	{
		return !$this->getCurrentStep()->isEndPoint();
	}

	/**
	 * @return 
	 */
	public function getNextStep()
	{
		return null;
	}

	/**
	 * @return 
	 */
	public function getCurrentStep()
	{
		return $this->getTrail()->last()->current();
	}

	/**
	 *
	 */
	public function isHandled()
	{
		return (null !== $this->trail);
	}
}
