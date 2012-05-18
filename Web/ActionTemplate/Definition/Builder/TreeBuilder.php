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
// @namesapce
namespace Rock\Component\Web\ActionTemplate\Definition\Builder;
// @use
use Rock\Component\Configuration\Definition\Builder\Tree\TreeBuilder as BaseBuilder;
// @use
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\RootNode;

/**
 * TreeBuilder 
 * 
 * @uses Tree
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class TreeBuilder extends BaseBuilder
{
	public function __construct()
	{
		parent::__construct();

		$this->initRoot(new RootNode());
	}
}
