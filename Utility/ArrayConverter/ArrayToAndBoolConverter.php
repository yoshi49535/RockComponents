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
 * ArrayToAndBoolConverter 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ArrayToAndBoolConverter 
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

		$result = true;
		foreach($collection as $value)
			if(null !== $value)
				$result &= (bool)$value;

		return (bool)$result;
	}
}
