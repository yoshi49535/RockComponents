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
 * FlowPathStateNode 
 * 
 * @uses FlowPathComponentNode
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class FlowPathStateNode extends FlowPathComponentNode
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

		$this->setParameter('component_name', 'state');
	}

	/**
	 * doValidate 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doValidate()
	{

		if((null !== ($prev = $this->getPrevSibling())) && 
		   ($prev instanceof FlowPathStateNode))
		{
			$node = new FlowPathConditionNode($this->getTree(), sprintf('%s_to_%s', $prev->getName(), $this->getName()));
			
			$this->setPrevSibling($node);
		}
	}

	public function asEntry()
	{
		$this->setParameter('is_entry', true);
		return $this;
	}
}
