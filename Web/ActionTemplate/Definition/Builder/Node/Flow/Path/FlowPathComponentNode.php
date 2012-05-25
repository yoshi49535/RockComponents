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

class FlowPathComponentNode extends Node
{
	const TYPE_STATE      = 'state';
	const TYPE_PAGE       = 'page';
	const TYPE_CONDITION  = 'cond';

	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $provider;
	/**
	 * delegate 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $delegate;
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $type;

	/**
	 * setComponentType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function setComponentType($type)
	{
		switch($type)
		{
		case self::TYPE_STATE:
		case self::TYPE_PAGE:
		case self::TYPE_CONDITION:
			$this->type  = $type;
			break;
		default:
			throw new \Exception('Invalid Type is given.');
		}
	}

	/**
	 * getComponentType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getComponentType()
	{
		return $this->type;
	}

	/**
	 * getDelegateMethod 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegateMethod()
	{
		return $this->delegate;
	}
	/**
	 * setDelegate 
	 * 
	 * @param mixed $object 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function setDelegateMethod($method)
	{
		$this->delegate = $method;
	}

	/**
	 * delegate 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function delegate($method)
	{
		$this->setDelegateMethod($method);

		return $this;
	}

	public function provider($provider)
	{
		$this->setDelegatorProvider($provider);

		return $this;
	}
	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate()
	{
		parent::validate();

		if((FlowPathComponentNode::TYPE_STATE === $this->getComponentType()) ||
		   (FlowPathComponentNode::TYPE_PAGE === $this->getComponentType()))
		{
			if((null !== ($prev = $this->getPrevSibling())) && 
			   ((FlowPathComponentNode::TYPE_STATE === $prev->getComponentType()) ||
			    (FlowPathComponentNode::TYPE_PAGE === $prev->getComponentType()) ) )
			{
				$node = new FlowPathComponentNode($this->getTree(), sprintf('%s_to_%s', $prev->getName(), $this->getName()));
				$node->setComponentType(FlowPathComponentNode::TYPE_CONDITION);
				
				$this->setPrevSibling($node);
			}
		}
	}

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
}
