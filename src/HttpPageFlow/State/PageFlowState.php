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

namespace Rock\Components\Http\Flow\State;

// <BaseClass>
use Rock\Components\Flow\State\GraphFlowState as BaseState;
// <Interface>
use Rock\Components\Http\Flow\State\IPageFlowState;
// <Use>
use Rock\Components\Flow\GraphFlow;
use Rock\Components\Http\Flow\Session\ISession;
// <Use> : Output
use Rock\Components\Flow\Output\IOutput;
use Rock\Components\Container\Graph\Path\IPath as IGraphPath;

/**
 *
 */
class PageFlowState extends BaseState
  implements
    IPageFlowState
{
	protected $session;

	/** 
	 *
	 */
	public function __construct(GraphFlow $flow, ISession $session, IPath $path = null)
	{
		parent::__construct($flow, $path);

		$this->setSession($session);
	}
	/** 
	 *
	 */
	public function setSession(ISession $session)
	{
		$this->session  = $session;

		$this->session->addCleanFunction(array($this, 'doCleanSession'));
	}

	public function doCleanSession()
	{
		// clean session 
		$this->getSession()->set('trail', $this->trail->pack());
	}
	/** 
	 *
	 */
	public function getSession()
	{
		return $this->session;
	}
	/**
	 *
	 */
	public function getTrail()
	{
		if(!$this->trail)
		{
			// Create Empty trail
			$this->trail = parent::getTrail();

			// recover
			$trails  = $this->getSession()->get('trail', array());
			$this->trail->unpack($trails);
		}

		return $this->trail;
	}
	/**
	 * @return bool Has next on flow or not
	 */
	public function hasPrev()
	{
		return !$this->getCurrent()->isEntryPoint() && !$this->getCurrent()->isEndPoint();
	}
}
