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
// @namespace
namespace Rock\Component\Automaton\Traversal;
// @use Automaton Interface
use Rock\Component\Automaton\IAutomaton;

/**
 * Traversal 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Traversal 
  implements 
    ITraversal
{
	/**
	 * owner 
	 * 
	 * @var IAutomaton
	 * @access protected
	 */
	protected $owner;

	/**
	 * input 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $input;

	/**
	 * output 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $output;

	/**
	 * trail 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $trail;

	/**
	 * __construct 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(IAutomaton $owner)
	{
		$this->owner  = $owner;

		// Initialize
		$this->trail  = $this->owner->createTrail();
	}

	/**
	 * getInput 
	 * 
	 * @access public
	 * @return void
	 */
	public function getInput()
	{
		return $this->input;
	}

	/**
	 * getOutput 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 * getTrail 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTrail()
	{
		return $this->trail;
	}
}
