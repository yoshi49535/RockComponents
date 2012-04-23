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
namespace Rock\Components\Http\Flow\Factory;
// <Base>
use Rock\Components\Flow\Factory\TypedFactory;
// <Use>
use Rock\Components\Http\Flow\Session\ISessionManager;
use Rock\Components\Http\Flow\Type\DefaultType;
use Rock\Components\Http\Flow\Builder\IHttpBuilder;
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
		$this->defaultType = new DefaultType();
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
		if(($builder instanceof IHttpBuilder) && $this->sessions)
			$builder->setSessionManager($this->getSessionManager());
		return $builder;
	}
}
