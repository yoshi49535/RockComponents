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
 * ArrayToOrBoolConverter 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ArrayToOrBoolConverter 
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
		if((null === $collection) || 0 === count($collection))
			return null;

		$result = false;
		foreach($collection as $value)
			if(null !== $value)
				if(($result |= (bool)$value))
					break;

		return $result;
	}
}
