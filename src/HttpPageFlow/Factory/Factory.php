<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
// <Interface>
namespace Rock\Component\Http\Flow\Factory;
// <Base>
use Rock\Component\Flow\Factory\TypedFactory;
// <Use>
use Rock\Component\Http\Flow\Session\ISessionManager;
use Rock\Component\Http\Flow\Type\DefaultType;
use Rock\Component\Http\Flow\Builder\IHttpFlowBuilder;
/**
 *
 */
class Factory extends TypedFactory
{
	/**
	 *
	 */
	protected $sessions;
	/**
	 *
	 */
	public function __construct(ISessionManager $manager = null)
	{
		parent::__construct();
		$this->sessions = $manager;
	}
	/**
	 *
	 */
	protected function init()
	{
		$this->defaultTypeClass = '\\Rock\\Component\\Http\\Flow\\Type\\DefaultType';
		$this->builderClass  = 'Rock\\Component\\Http\\Flow\\Buidler\\Builder';
	}
	/**
	 *
	 */
	public function setSessionManager(ISessionManager $manager)
	{
		$this->sessions  = $manager;
	}

	/**
	 *
	 */
	public function getSessionManager()
	{
		return $this->sessions;
	}

	/**
	 *
	 */
	public function createBuilder($type = null)
	{
		$builder = parent::createBuilder($type);
		if(($builder instanceof IHttpFlowBuilder) && $this->sessions)
			$builder->setSessionManager($this->getSessionManager());
		return $builder;
	}
}
