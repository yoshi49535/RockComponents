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
namespace Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow;
// @use
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Node;
// @use 
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\Path\FlowPathNode;


/**
 * FlowNode 
 * 
 * @uses Node
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class FlowNode extends Node
{
	protected $provider;

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		
	}

	/**
	 * path 
	 * 
	 * @access public
	 * @return void
	 */
	public function path($name = 'path')
	{
		$this->addChild($node = $this->getTree()->getNodeFactory()->create('path'));
		$node->setName($name);
		
		return $node;
	}

	/**
	 * setDelegatorProvider 
	 * 
	 * @param mixed $provider 
	 * @access public
	 * @return void
	 */
	public function setDelegatorProvider($provider)
	{
		$this->provider = $provider;
	}

	/**
	 * getDelegatorProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegatorProvider()
	{
		return $this->provider;
	}

	/**
	 * provider 
	 * 
	 * @param mixed $provider 
	 * @access public
	 * @return void
	 */
	public function provider($provider)
	{
		$this->setDelegatorProvider($provider);
		return $this;
	}
}
