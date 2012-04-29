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
namespace Rock\Component\Http\Flow\Builder;
// <Base>
use Rock\Component\Flow\Builder\Builder as BaseBuilder;
// <Interface>
use Rock\Component\Http\Flow\Builder\IHttpFlowBuilder;
// <Use> : Flow Component
use Rock\Component\Flow\Configuration\IFlowConfiguration;
use Rock\Component\Flow\Factory\IFactory as IFlowFactory;
// <Use> : Session Component
use Rock\Component\Http\Flow\Session\ISessionManager;
use Rock\Component\Http\Flow\IHttpPageFlow;
// <Use> : Request 
use Rock\Component\Http\Flow\Request\Resolver\IRequestResolver;

/** 
 *
 */
class Builder extends BaseBuilder
  implements
    IHttpFlowBuilder
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

		if($flow && ($flow instanceof IHttpPageFlow))
			$flow->setSessionManager($this->getSessionManager());

		return $flow;
	}


	// Definition Functions
	/** 
	 *
	 */
	public function addPage($name)
	{
		//$lastInserted  = $this->definitions->last();
		//	
		//$this->definitions->add(new StateDefinition(array('name' => $name)));
		//if($lastInserted->isEdge())
		//{
		//	// set the target as this definition, and close the definitiom
		//	$lastInserted->setAttribute('target',$name);
		//}

		return $this;
	}
	/** 
	 *
	 */
	public function addCondition($listener)
	{
		//$lastInserted  = $this->defintions->last();
		//if($lastInserted->isEdge())
		//{
		//	// 
		//	$lastInserted->setAttribute('callback');
		//}
		//else
		//{
		//	$edgeDefinition = new EdgeDefinition();
		//	$edgeDefinition->setAttribute('source', $lastInserted->getAttribute('name'));
		//	$edgeDefinition->setAttribute('listener', new Reference($listener[0]));
		//	$edgeDefinition->setAttribute('listener', $listener[1]);
		//	$this->definitions->add($edgeDefinition);
		//}

		return $this;
	}
}
