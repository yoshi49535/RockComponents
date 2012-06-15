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


/**
 * FlowPathConditionNode 
 * 
 * @uses FlowPathComponentNode
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class FlowPathConditionNode extends FlowPathComponentNode
{
	/**
	 * init 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
		parent::init();

		$this->setParameter('component_name', 'condition');
	}

	/**
	 * doValidate 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doValidate()
	{
	}
}
