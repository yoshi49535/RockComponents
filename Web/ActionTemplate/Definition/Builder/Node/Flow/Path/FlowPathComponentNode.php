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
namespace Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path;
// @extends
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Node;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\FlowNode;

abstract class FlowPathComponentNode extends Node
{
	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $provider;
	/**
	 * delegates
	 * 
	 * @var array
	 * @access protected
	 */
	protected $delegates;

	/**
	 * addDelegate 
	 * 
	 * @param mixed $delegate
	 * @access public
	 * @return void
	 */
	public function addDelegate($delegate)
	{
		$this->delegates[] = $delegate;
	}

	/**
	 * delegate 
	 * 
	 * @param mixed.. $arg1
	 * @access public
	 * @return void
	 */
	public function delegate($arg1)
	{
		if(1 === count($args = func_get_args()))
			$this->addDelegate($args[0]);
		else 
			$this->addDelegate(array($args[0], $args[1]));

		return $this;
	}

	public function provider($provider)
	{
		$this->setDelegatorProvider($provider);

		return $this;
	}

	public function getDelegates()
	{
		return $this->delegates;
	}

	public function validate()
	{
		parent::validate();

		$this->doValidate();
	}

	abstract protected function doValidate();

	/**
	 * getDelegatorProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegatorProvider()
	{
		if(!$this->provider)
			return $this->getParent()->getDelegatorProvider();
		
		return $this->provider;
	}

	public function getComponentName()
	{
		return $this->getParameter('component_name');
	}
}
