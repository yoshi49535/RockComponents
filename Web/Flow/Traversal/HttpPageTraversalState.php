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

namespace Rock\Component\Web\Flow\Traversal;

// <BaseClass>
use Rock\Component\Flow\Traversal\GraphTraversalState as BaseTraversal;
// <Interface>
use Rock\Component\Web\Flow\Traversal\IHttpPageTraversalState;
// <Use>
use Rock\Component\Flow\GraphFlow;
use Rock\Component\Web\Flow\Session\ISession;
// <Use> : Output
use Rock\Component\Flow\Output\IOutput;
use Rock\Component\Container\Graph\Path\IPath as IGraphPath;

/**
 *
 */
class HttpPageTraversalState extends BaseTraversal
  implements
    IHttpPageTraversalState
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

	public function reset()
	{
		parent::reset();
		$this->getSession()->replace(array('flow_hash' => $this->getSession()->get('flow_hash')));

		// Force save
		$this->getFlow()->getSessionManager()->save();
	}
}
