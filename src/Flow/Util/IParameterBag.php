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
namespace Rock\Components\Flow\Util;
interface IParameterBag
{
	/**
	 *
	 */
	public function get($idx);

	/**
	 *
	 */
	public function set($idx, $value);

	/**
	 *
	 */
	public function all();
	
	/**
	 *
	 */
	public function has($idx);
}
