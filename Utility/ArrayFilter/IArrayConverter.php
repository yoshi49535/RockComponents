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
 * IArrayConverter 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IArrayConverter
{
	/**
	 * resolve 
	 * 
	 * @param array $collection 
	 * @access public
	 * @return void
	 */
	function resolve(array $collection);
}
