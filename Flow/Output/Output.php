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

// <Namespace>
namespace Rock\Component\Flow\Output;
// <Interface>
use Rock\Component\Flow\Util\IParameterBag;
use Rock\Component\Flow\Output\IOutput;

// <Use> : Flow Component
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Flow\Traversal\ITraversalState;
// <Use> : ParameterBag
use Rock\Component\Flow\Util\ParameterBag;

class Output 
  implements 
    IOutput,
	IParameterBag
{
	/**
	 *
	 */
	protected $input;
	/**
	 *
	 */
	protected $traversal;
	/**
	 *
	 */
	protected $params;

	/**
	 *
	 */
	protected $bSuccess;
	/**
	 *
	 */
	public function __construct($params = array())
	{
		$this->params = new ParameterBag($params);
		$this->traversal  = null;
		$this->bSuccess   = true;
	}

	
	/**
	 * Get related input
	 */
	public function getInput()
	{
		return $this->getTraversal()->getInput();
	}

	/**
	 *
	 */
	public function getTraversal()
	{
		if(!$this->traversal)
			throw new \Exception('Traversal is not initialized, yet.');
		return $this->traversal;
	}

	/**
	 *
	 */
	public function setTraversal(ITraversalState $traversal)
	{
		$this->traversal  = $traversal;
	}

	// IParameterBag Impl
	/**
	 *
	 */
	public function get($idx)
	{
		return $this->params->get($idx);
	}
	/**
	 *
	 */
	public function set($idx, $value)
	{
		$this->params->set($idx, $value);
	}
	/**
	 *
	 */
	public function has($idx)
	{
		$this->params->has($idx);
	}
	/**
	 *
	 */
	public function all()
	{
		return $this->params->all();
	}

	/**
	 *
	 */
	public function getParameterBag()
	{
		return $this->params;
	}

	//
	/**
	 *
	 */
	public function __toString()
	{
		return sprintf("Flow Output:[Class='%s']", get_class($this));
	}

	/**
	 *
	 */
	public function isSuccess()
	{
		return $this->bSuccess;
	}

	/**
	 *
	 */
	public function success()
	{
		$this->bSuccess = true;
	}
	/**
	 *
	 */
	public function fail()
	{
		$this->bSuccess = false;
	}
}
