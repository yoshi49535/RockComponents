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
namespace Rock\Components\Http\Flow;

// <Base>
use Rock\Components\Flow\GraphFlow as BaseFlow;
// <Use> : Flow Components
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Flow\State\IFlowState;
use Rock\OnSymfony\FlowBundle\Exception\FlowStateException;
use Rock\OnSymfony\HttpFlowBundle\Request\FlowRequests;

// <Use> : Flow Web-Page Components
use Rock\OnSymfony\HttpFlowBundle\Session\IFlowSession;
use Rock\Components\Http\Flow\State\HttpState;

class Flow extends BaseFlow
{
	/**
	 *
	 */
	public function doRecoverState(IFlowState $state)
	{
		// Recover FollowedPath From Session
		$trail = $this->getPath()->createTrail();

		$session = $state->getSession();

		if(count($session->getTrails()) == 0)
		{
			throw new FlowStateException('Flow has never forwarded.');
		}
		
		$trail->unserialize($session->getTrailData());

		$state->setTrail($trail);
	}
	/**
	 *
	 */
	public function doHandleInput(IInput $input, IFlowState $state)
	{
		$trail    = $state->getTrail();
		if(!$trail)
		{
			throw new InitializeException('Failed to initilize Flow.');
		}

		$newTrail = null;


		switch($direction)
		{
		case FlowDirections::BACKWARD:
			// pop last state from path,
			// It is also release edges
			$trail->popLastState();
			break;
		case FlowDirections::FORWARD:
			parent::doHandleInput($input, $state);
			break;
		case FlowDirections::STAY:
		default:
			// Show current state page
			if($trail->count() === 0)
			{
				// execute first state
				$graph       = $this->getPath();
				$newTrail    = $graph->handle($input);
				//
			    foreach($newTrail->getTrail() as $component)
			    {
			    	$trail->push($component);
			    }
			}
			break;
		}
	}

	/**
	 *
	 */
	public function createFlowState()
	{
		return new HttpState($this);
	}
}
