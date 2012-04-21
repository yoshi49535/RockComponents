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

namespace Rock\Components\Http\Flow\Builder;

// <Base>
use Rock\Components\Flow\Builder\Builder as BaseBuilder;

// <Use> : Flow Components
use Rock\Components\Flow\Configuration\IFlowConfiguration;
use Rock\Components\Flow\Factory\IFactory as IFlowFactory;

// <Use> : Http Flow Components
use Rock\Components\Http\Flow\Session\ISessionManager;
use Rock\Components\Http\Flow\Request\Resolver\IRequestResolver;

/** 
 *
 */
class Builder extends BaseBuilder
{
	protected $sessions;

	public function __construct(IFlowFactory $factory, ISessionManager $sessions)
	{
		parent::__construct($factory);

		$this->sessions = $sessions;
	}
	/**
	 *
	 */
	public function build($rebuild = false)
	{
		$flow = parent::build($rebuild);

		if($flow)
			$flow->setSessionManager($this->sessions);
		return $flow;
	}
}
