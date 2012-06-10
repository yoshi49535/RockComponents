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
	 * delegates
	 * 
	 * @var array
	 * @access protected
	 */
	protected $delegates;
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

	public function getDelegates()
	{
		return $this->delegates;
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
