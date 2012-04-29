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

class FlowDefinitionContainer extends Container
{
	public function init()
	{
		if(!$this->builder)
			$this->builder  = new FlowBuilder();
	}
	public function addDefinition(IDefinition $definition)
	{
		if($definition instanceof FlowDefinition)
		{
			$this->definitions[$definition->id]  = $definition;
		}
	}

}
