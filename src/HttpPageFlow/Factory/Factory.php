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
	public function __construct(IContainer $container, ISessionManager $manager = null)
	{
		parent::__construct($container);
		$this->sessions = $manager;
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
	public function create($alias)
	{

		$flow  = parent::create($alias);

		if(($flow instanceof IHttpPageFlow) && $this->sessions)
			$flow->setSessionManager($this->getSessionManager());
		return $flow;
	}
}
