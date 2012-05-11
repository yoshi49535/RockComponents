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

namespace Rock\Component\Web\Flow\Traversal;

// <Interface>
use Rock\Component\Flow\Traversal\ITraversalState;
// <Use>
use Symfony\Component\Routing\RouterInterface;
use Rock\OnSymfony\HttpFlowBundle\Request\FlowRequests;

class HttpPageTraversalStateProxy 
  implements
    ITraversalState,
	IHttpPageTraversalState
{
	/**
	 *
	 */
	protected $parent;
	/**
	 * To generate Url for next and prev, we need router
	 * @var Router
	 */
	protected $router;
	/**
	 *
	 */
	protected $route;
	/**
	 *
	 */
	protected $routeParams;

	/**
	 *
	 */
	public function __construct(ITraversalState $traversal, RouterInterface $router, $route, $routeParams = array())
	{
		// Initialize attributes
		$this->parent      = $traversal;
		$this->router      = $router;
		$this->route       = $route;
		$this->routeParams = $routeParams;
	}

	/**
	 *
	 */
	public function getRouter()
	{
		return $this->router;
	}
	/**
	 *
	 */
	public function getRoute()
	{
		return $this->route;
	}
	/**
	 *
	 */
	public function getRouteParams()
	{
		return $this->routeParams;
	}

	/**
	 * @return bool Has next on flow or not
	 */
	public function hasPrevStep()
	{
		return $this->parent->hasPrevStep();
	}

	/**
	 * @return string Return the URL for prev on flow
	 */
	public function getPrevStep()
	{
		$params  = array_merge(
			$this->getRouteParams(),
			array(FlowRequests::DIRECTION_KEY => FlowRequests::DIRECTION_PREVIOUS)
		);

		$url  = $this->getRouter()->generate(
			$this->getRoute(),
			$params
		);
		return $url;
	}

	/**
	 * @return bool Has prev on flow or not
	 */
	public function hasNextStep()
	{
		return $this->parent->hasNextStep();
	}

	/**
	 * @return string Return the URL for next on flow
	 */
	public function getNextStep()
	{
		$params  = array_merge(
			$this->getRouteParams(),
			array(FlowRequests::DIRECTION_KEY => FlowRequests::DIRECTION_NEXT)
		);
		$url  = $this->getRouter()->generate(
			$this->getRoute(),
			$params
		);
		return $url;
	}

	/**
	 * @return string Return the URL for current on flow
	 */
	public function getCurrentStep()
	{
		$params  = array_merge(
			$this->getRouteParams(),
			array(FlowRequests::DIRECTION_KEY => FlowRequests::DIRECTION_NEXT)
		);

		$url  = $this->getRouter()->generate(
			$this->getRoute(),
			$params
		);
		return $url;
	}

	/*
	 *
	 */
	public function isHandled()
	{
		return $this->parent->isHandled();
	}
}
