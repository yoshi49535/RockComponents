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
namespace Rock\Component\Flow\State;

// <BaseClass>
use Rock\Component\Flow\State\FlowState;
// <Use>
use Rock\Component\Flow\GraphFlow;
use Rock\Component\Container\Graph\Path\IPath as IGraphPath;
use Rock\Component\Container\Graph\Vertex\IVertex;

/**
 * GraphFlowState is an extended Class of FlowState.
 * This class hold current state in Automaton,
 * the total path to current state,
 * and so on.
 */
class GraphFlowState extends FlowState
{
	/**
	 * The trail from start point to current
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
	public function hasPrev()
	{
		return !$this->getCurrent()->isEntryPoint();
	}

	/**
	 * @return string Return the URL for prev on flow
	 */
	public function getPrev()
	{
		$ptr = $this->getTrail()->last();
		while(!($ptr->current() instanceof IVertex))
			$ptr--;
		return $ptr->current();
	}
	/**
	 * @return bool Has prev on flow or not
	 */
	public function hasNext()
	{
		return !$this->getCurrent()->isEndPoint();
	}

	/**
	 * @return 
	 */
	public function getNext()
	{
		$cur    = $this->getCurrent();
		$graph  = $this->getTrail()->getGraph();
		foreach($graph->getEdgesFrom($cur) as $edge)
		{
			return $edge->getTarget();
		}
	}

	/**
	 * @return 
	 */
	public function getCurrent()
	{
		return $this->getTrail()->last()->current();
	}

	/**
	 *
	 */
	public function isHandled()
	{
		return ((null !== $this->trail) && ($this->trail->count() > 0));
	}

	public function isKeepAlive()
	{
		return !$this->getTrail()->last()->current()->isEndPoint();
	}
	/**
	 *
	 */
	public function reset()
	{
		// create trail
		$graph = $this->getFlow()->getPath();
		$this->trail = $graph->createPath();
	}
}
