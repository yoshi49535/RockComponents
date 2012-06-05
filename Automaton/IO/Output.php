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

use Rock\Component\Utility\Bag\ParameterBag;
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
	 * @access private
	 */
	private $owner;

	/**
	 * trail 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $trail;

	/**
	 * assigns 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $assigns;

	/**
	 * params 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $params;


	/**
	 * compiled 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $compiled;
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
		$this->trail  = null;
		$this->assigns= array();
		$this->compiled = false;
		$this->params = new ParameterBag();
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

	/**
	 * assign 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function assign($name)
	{
		$args = func_get_args();
		
		foreach($args as $arg)
			$this->assigns[] = $arg;
	}

	/**
	 * getAssigns 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAssigns()
	{
		return $this->assigns;
	}

	/**
	 * compile 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function compile(array $params = array())
	{
		$params = array_intersect_key($params, array_flip($this->getAssigns()));

		$this->replaceParameters($params);
		$this->compiled  = true;

		return $this;
	}

	/**
	 * replaceParameters 
	 * 
	 * @param array $params 
	 * @access protected
	 * @return void
	 */
	protected function replaceParameters($params = array())
	{
		$this->params->replaceAll($params);
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
		if(!$this->compiled)
			throw new \Exception('Output is not compiled yet.');
		return $this->params->has($name);
	}

	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function get($name)
	{
		if(!$this->compiled)
			throw new \Exception('Output is not compiled yet.');
		return $this->params->get($name);
	}

	/**
	 * all 
	 * 
	 * @access public
	 * @return void
	 */
	public function all()
	{
		if(!$this->compiled)
			throw new \Exception('Output is not compiled yet.');
		return $this->params->all();
	}

	public function isCompiled()
	{
		return $this->compiled;
	}
}
