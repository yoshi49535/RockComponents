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
namespace Rock\Component\Configuration\Definition\Builder\Tree;
// @extends
use Rock\Component\Container\Tree\Tree;
// @interface
use Rock\Component\Configuration\Definition\Builder\IDefinitionBuilder;
// @use
use Rock\Component\Configuration\Definition\Definition;
use Rock\Component\Configuration\Definition\Definition\Builder\Tree\DefinitionNode;

/**
 * TreeDefinitionBuilder 
 * 
 * @uses Tree
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class TreeDefinitionBuilder extends Tree 
  implements
    IDefinitionBuilder
{
	/**
	 * build 
	 *   Build All Definitions 
	 * @param mixed $itr 
	 * @access protected
	 * @return void
	 */
	public function build($itr = null)
	{
		//
		if(!$itr)
			$itr  = $this->getIterator();

		$definitions = $this->doBuild($itr);

		return $definitions;
	}

	/**
	 * doBuild 
	 * 
	 * @param mixed $itr 
	 * @access protected
	 * @return void
	 */
	protected function doBuild($itr)
	{
		$definitions = array();
		if($itr)
			$definitions[] = $itr->current()->getDefinition();

		// Build for children
		if($itr->current()->hasChildren())
		{
			$child = $itr->getChildIterator();
			do
			{
				// 
				$definitions = array_merge($definitions, $this->doBuild($child));
			} while($child->next());
		}

		return $definitions;
	}

	/**
	 * buildDefinition 
	 * 
	 * @param IDefinitionNode $node 
	 * @access public
	 * @return void
	 */
	public function buildDefinition(IDefinitionNode $node)
	{
		$definition = new Definition($node->getParameter('id'), $node->getParameterBag()->all());

		return $definition;
	}
}

