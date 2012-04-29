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
// <Namespace>
namespace Rock\Component\Flow\Definition;

/**
 *
 */
class StateDefinition extends BaseDefinition
  implements
    IStateDefinition
{
	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->class = 'Rock\\Component\\Flow\\Graph\\State\\State';
	}

	/**
	 *
	 */
	public function addNext($name)
	{
		// Add State Definition
		$newState = new StateDefinition($name);
		$this->getContainer()->addDefinition($newState);

		// Add Edge Definition
		$newEdge  = new EdgeDefinition($this, $newState);
		$this->getContainer()->addDefinition($newEdge);

		return $this;
	}

	/**
	 *
	 */
	public function end()
	{
		return $this->parent;
	}
}
