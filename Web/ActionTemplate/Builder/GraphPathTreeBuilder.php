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

class GraphPathTreeBuilder
{

	public function buildDefinition($itr)
	{
		switch($itr->getType())
		{
		case 'flow':
			
			break;

		}
	}
	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build($itr = null)
	{
		$definitions   = array();
		// Build Graph Definition
		$path = $this->getPathDefinition();

		// Build Components' Definitions
		$itr  = new Iterator($this->root());
		$edge = null;
		// forward
		while($itr->next())
		{
			$node = $itr->current();
			// Validate Node Setting
			$node->validate();

			$definition = $this->buildDefinitionForNode($node);
			if($node->getType() === 'condition')
			{
				$edge = $definition;
			}
			else
			{
				if(count($states) > 0)
				{
					$last   = $states[count($states) - 1];
					// add condition beteween current and last 
					if(!$edge)
						$edge = $this->buildEdgeDefinition($path->getSubId($last->getAttribute('name').'_to_'.$definition->getAttribute('name')));

					$edge->setArguments(array($last->getReference(), $definitions->getReference()));
					$edges[]   = $edge;
				}
				// add State Definition
				$states[]  = $definition;
				$edge      = null;
			}
		}
		
		return $definitions;
	}

	public function buildEdgeDefinition($name)
	{
		$definition = new Definition($name);

		return $definition;
	}
	/**
	 * buildPathDefinition 
	 * 	Build Flow Path Definition as FlowGraph
	 * @access public
	 * @return void
	 */
	public function buildPathDefinition()
	{
		$definition   = new Definition($this->getFlow()->getSubId('graph'));
		// Set Path Class
		$definition->setClass('\\Rock\\Component\\Flow\\Graph\\FlowGraph');
		// Set Path Constructor Arguments
		$definition->setArguments(array($this->getFlow()->getReference()));

		return $definition;
	}
}
