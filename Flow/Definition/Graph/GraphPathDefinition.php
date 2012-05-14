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
namespace Rock\Component\Flow\Definition\Graph;
// @extends 
use Rock\Component\Flow\Definition\Path\AbstractPathDefinition;


/**
 * GraphPathDefinition 
 * 
 * @uses AbstractPathDefinition
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class GraphPathDefinition extends AbstractPathDefinition
{
	/**
	 * __construct 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		// Class Path
		$this->class  = '\\Rock\\Component\\Flow\\Graph\\FlowGraph';
	}
}
