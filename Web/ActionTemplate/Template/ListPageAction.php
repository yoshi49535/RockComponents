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

class ListPageAction extends PageAction
{
	/**
	 * setCollection 
	 * 
	 * @param mixed $collection 
	 * @access public
	 * @return void
	 */
	public function setCollection($collection)
	{

	}

	public function getCollection()
	{
		$collection = $this->doCollectData();
		
		return $collection;
	}
	public function execute($input)
	{
		$this->collection  = $this->getCollection();
	}
}
