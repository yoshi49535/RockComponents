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

class TreeBuilder extends AbstractBuilder
  implements
    IDefinitionBuilder
{
	public function getSupportNodes()
	{
		return array(
			'page',
		);
	}
}