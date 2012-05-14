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
namespace Rock\Component\Flow\Definition\Path;
// @extends
use Rock\Component\Configuration\Definition\ContainerAwareDefinition;
// @use Call
use Rock\Component\Configuration\Definition\Call;
// @use PathComponent Definition
use Rock\Component\Flow\Definition\Path\Component\IPathComponentDefinition;


/**
 * AbstractPathDefinition 
 * 
 * @uses ContainerAwareDefinition
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class AbstractPathDefinition extends ContainerAwareDefinition
  implements
    IPathDefinition
{
	/**
	 * components 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $components;

	//---
	// DefinePhase Functions
	public function addComponent(IPathComponentDefinition $definition)
	{
		$this->components[]  = $definition;
		{
			$definition->setPathDefinition($this);
		}

		// 
	}

	//---
	// CompilePhase
	/**
	 *
	 */
	protected function doConfigurateDefinition()
	{
		parent::doConfigurateDefinition();
		foreach($this->components as $component)
			$this->registComponentCall($component);
	}

	/**
	 *
	 */
	protected function registComponentCall(IPathComponentDefinition $definition)
	{
		$this->getContainer()->addDefinition($definition);

		if($definition instanceof IStateDefinition)
		{
			$this->addCall(new Call(
				'addVertex',
				array($definition->getReference())
			));
		}
		else if($definition instanceof ConditionDefinition)
		{
			$this->addCall(new Call(
				'addEdge',
				array($definition->getReference())
			));
		}
	}
}
