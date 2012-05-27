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
namespace Rock\Component\Utility\ArrayConverter;


/**
 * ArrayToArrayConverter 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ArrayToArrayConverter 
  implements
    IArrayConverter
{
	/**
	 * resolve 
	 * 
	 * @param array $collection 
	 * @access public
	 * @return void
	 */
	public function resolve(array $collection)
	{
		return $collection;
	}
}
