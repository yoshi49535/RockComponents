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
			parent::getTrail();

			// recover
			$this->getSession()->recoverTrail($this->trail);
		}
		return $this->trail;
	}
}
