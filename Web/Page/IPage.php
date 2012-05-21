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
namespace Rock\Component\Web\Page;

/**
 * IPage 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IPage
{
	/**
	 * getUrl 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function getUrl($params = array());

	/**
	 * getPage 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();
}
