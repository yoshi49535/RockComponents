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
use Rock\Component\Flow\Traversal\Traversal;
// <Interface>
use Rock\Component\Web\Flow\Traversal\IHttpFlowTraversal;
// <Use>
use Rock\Component\Web\Flow\IHttpFlow;
use Rock\Component\Web\Session\ISession;
// <Use> : Output
use Rock\Component\Web\Flow\IO\Output;
use Rock\Component\Automaton\Path\Trail\ITrail;

/**
 * HttpTraversal 
 * 
 * @uses Traversal
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class HttpTraversal extends Traversal
  implements
    IHttpFlowTraversal
{
	protected $session;

	/**
	 * __construct 
	 * 
	 * @param IHttpFlow $flow 
	 * @param ISession $session 
	 * @param ITrail $path 
	 * @access public
	 * @return void
	 */
	public function __construct(IHttpFlow $flow, ISession $session, ITrail $path = null)
	{
		parent::__construct($flow, $path);

		$this->setSession($session);
	}
	/**
	 * setSession 
	 * 
	 * @param ISession $session 
	 * @access public
	 * @return void
	 */
	public function setSession(ISession $session)
	{
		$this->session  = $session;

		$this->session->addCleanFunction(array($this, 'doCleanSession'));

		if(0 === ($expire = $this->session->get('expires')))
		{
			// skip
		}
		else if(time() > $expire)
		{
			// Make the value empty
			$this->session->getParameterBag()->replaceAll(array());
		}
	}

	/**
	 * doCleanSession 
	 * 
	 * @access public
	 * @return void
	 */
	public function doCleanSession()
	{
		// clean session 
		$this->getSession()->set('trail', $this->getTrail()->pack());

		$ttl  = $this->getInput()->get('ttl', 0);
		if($ttl > 0)
			$this->getSession()->set('expires', time() + $ttl);
		else
			$this->getSession()->set('expires', 0); 
	}

	/**
	 * getSession 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSession()
	{
		return $this->session;
	}

	/**
	 * getTrail 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTrail()
	{
		if(!$this->trail)
		{
			// Create Empty trail
			$this->trail = parent::getTrail();

			// recover
			$trails  = $this->getSession()->get('trail', array());
			if($trails)
				$this->trail->unpack($trails);
		}

		return $this->trail;
	}

	protected function initOutput()
	{
		$this->output  = new Output($this->getOwner());
	}
	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	public function reset()
	{
		parent::reset();
		$this->getSession()->getParameterBag()->replaceAll(array());

		// Force save
		$this->getSession()->save();
	}
}
