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

// @use IO Interface
use Rock\Component\Automaton\IO\IInput;
use Rock\Component\Automaton\IO\IOutput;
use Rock\Component\Automaton\IO\Output;

/**
 * Traversal 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Traversal extends ParameterBagContainer
  implements 
    ITraversal
{
	/**
	 * owner 
	 * 
	 * @var IAutomaton
	 * @access private
	 */
	private $owner;

	/**
	 * input 
	 * 
	 * @var mixed
	 * @access private
	 */
	protected $input;

	/**
	 * output 
	 * 
	 * @var mixed
	 * @access private
	 */
	protected $output;

	/**
	 * trail 
	 * 
	 * @var mixed
	 * @access private
	 */
	protected $trail;

	/**
	 * __construct 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(IAutomaton $owner, $params = array())
	{
		parent::__construct($params);
		$this->owner  = $owner;
	}

	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOwner()
	{
		return $this->owner;
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
	 * setInput 
	 * 
	 * @param IInput $input 
	 * @access public
	 * @return void
	 */
	public function setInput(IInput $input)
	{
		$this->input = $input;
	}

	public function hasInput()
	{
		return !is_null($this->input);
	}

	/**
	 * initOutput 
	 * 
	 * @access public
	 * @return void
	 */
	protected function initOutput()
	{
		$this->output  = new Output($this->getOwner());
	}
	/**
	 * getOutput 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOutput()
	{
		if(!$this->output)
			$this->initOutput();
			
		return $this->output;
	}

	/**
	 * setOutput 
	 * 
	 * @param IOutput $output 
	 * @access public
	 * @return void
	 */
	public function setOutput(IOutput $output)
	{
		$this->output;
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
			$this->trail  = $this->getOwner()->getPath()->createTrail();
		return $this->trail;
	}

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	public function reset()
	{
		$this->trail  = $this->owner->getPath()->createTrail();

		$this->initOutput();
	}

	/**
	 * has 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function has($name)
	{
		return parent::has($name) || $this->getInput()->has($name);
	}
	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function get($name, $default = null)
	{
		if(parent::has($name))
			return parent::get($name);

		return $this->getInput()->get($name, $default);
	}
}
