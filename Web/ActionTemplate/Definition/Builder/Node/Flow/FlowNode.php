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
		$this->add($node = new FlowPathNode($this->getTree(), $name));
		
		return $node;
	}

}
