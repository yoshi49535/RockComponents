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
namespace Rock\Component\Automaton\IO;
// @interfce
use Rock\Component\Automaton\IO\IOutput;
// @use Automaton Interface as Owner
use Rock\Component\Automaton\IAutomaton;
// @use Path Component
use Rock\Component\Automaton\Path\Trail\ITrail;

/**
 * Output 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Output
  implements
    IOutput
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $owner;

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
	}

	/**
	 * setTrail 
	 * 
	 * @param ITrail $trail 
	 * @access public
	 * @return void
	 */
	public function setTrail(ITrail $trail)
	{
		$this->trail  = $trail;
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
			$this->trail = $this->getOwner()->getPath()->createTrail();
		return $this->trail;
	}

	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return IAutomaton
	 */
	public function getOwner()
	{
		return $this->owner;
	}
}
