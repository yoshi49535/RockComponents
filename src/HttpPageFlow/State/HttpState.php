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
use Rock\Components\Http\Flow\State\IHttpFlowState;
// <Use>
use Rock\Components\Flow\GraphFlow;
use Rock\OnSymfony\HttpFlowBundle\Session\IFlowSession;

/**
 *
 */
class HttpState extends BaseState
  implements
    IHttpFlowState
{
	protected $session;

	public function __construct(GraphFlow $flow, IFlowSession $session = null, IPath $path = null)
	{
		parent::__construct($flow, $path);

		$this->session  = $session;
	}
	public function setSession(IFlowSession $session)
	{
		$this->session  = $session;
	}
	public function getSession()
	{
		return $this->session;
	}
}
