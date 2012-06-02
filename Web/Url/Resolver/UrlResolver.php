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

class UrlResolver
{
	private $tokens = array();

	/**
	 * __construct 
	 * 
	 * @param array $tokens 
	 * @access public
	 * @return void
	 */
	public function __construct($tokens = array())
	{
		if(is_array($tokens))
			$this->tokens = $tokens;
	}
	/**
	 * getToken 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getToken($key)
	{
		return array_key_exists($key, $this->tokens) ? $this->tokens[$key] : $key;
	}

	/**
	 * setToken 
	 * 
	 * @param mixed $key 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function setToken($key, $token)
	{
		$this->token[$key] = $token;
	}

	public function getTokens()
	{
		return $this->tokens;
	}
	/**
	 * resolveUrl 
	 * 
	 * @access public
	 * @return void
	 */
	public function resolveUrl()
	{
		return '#';
	}
}
