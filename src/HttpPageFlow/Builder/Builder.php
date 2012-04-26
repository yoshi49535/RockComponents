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
  implements
    IHttpBuilder
{
	protected $sessions;

	/**
	 *
	 */
	public function __construct(IFlowFactory $factory)
	{
		parent::__construct($factory);
	}

	/**
	 *
	 */
	public function setSessionManager(ISessionManager $sessions)
	{
		$this->sessions = $sessions;
	}
	/**
	 *
	 */
	public function getSessionManager()
	{
		if(!$this->sessions)
			throw new \Exception('SessionManager is not initialized.');
		return $this->sessions;
	}
	/**
	 *
	 */
	public function build($name)
	{
		$flow = parent::build($name);

		if($flow)
			$flow->setSessionManager($this->getSessionManager());
		return $flow;
	}
}
