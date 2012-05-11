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

// <Interface>
namespace Rock\Component\Web\Flow\Factory;
// <Base>
use Rock\Component\Flow\Factory\TypedFactory;
// <Use>
use Rock\Component\Web\Flow\Session\ISessionManager;
use Rock\Component\Web\Flow\Type\DefaultType;
use Rock\Component\Web\Flow\Builder\IHttpFlowBuilder;
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
