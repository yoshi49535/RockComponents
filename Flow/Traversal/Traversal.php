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
// @namespace
namespace Rock\Component\Flow\Traversal;
// @extends
use Rock\Component\Automaton\Traversal\Traversal as BaseTraversal;
// @use Automaton Interface
use Rock\Component\Automaton\IAutomaton;
//
// @use Output
use Rock\Component\Flow\IO\Output;

/**
 * Traversal class is a FlowAccessor or Proxy, which provide concealed-access-methods for current TraversalStae.
 */
class Traversal extends BaseTraversal
  implements
    IFlowTraversal
{
	/**
	 * keepAlive 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $keepAlive;

	/**
	 * __construct 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(IAutomaton $owner)
	{
		parent::__construct($owner);
		$this->keepAlive = true;
	}

	/**
	 * isKeepAlive 
	 * 
	 * @access public
	 * @return void
	 */
	public function isKeepAlive()
	{
		return $this->keepAlive;
	}

	/**
	 * setKeepAlive 
	 * 
	 * @param mixed $bAlive 
	 * @access public
	 * @return void
	 */
	public function setKeepAlive($bAlive)
	{
		$this->keepAlive  = $bAlive;
	}


	public function isHandled()
	{
		return ($this->getOutput()->getTrail()) > 0;
	}


	protected function initOutput()
	{
		$this->output = new Output($this->getOwner());
	}
}
