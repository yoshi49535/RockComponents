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
namespace Rock\Component\Web\Flow\Path\Page;

use Rock\Component\Web\Page\IPage as IBasePage;
interface IPage extends IBasePage
{
	/**
	 * hasNextPage 
	 * 
	 * @access public
	 * @return void
	 */
	function hasNextPage();

	/**
	 * hasPrevPage 
	 * 
	 * @access public
	 * @return void
	 */
	function hasPrevPage();
}
