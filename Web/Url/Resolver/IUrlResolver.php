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
namespace Rock\Component\Web\Url\Resolver;

interface IUrlResolver
{
	/**
	 * getToken 
	 * 
	 * @access public
	 * @return void
	 */
	function getToken($key);

	/**
	 * setToken 
	 * 
	 * @param mixed $key 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	function setToken($key, $token);
}
