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

interface IPageStackObserver
{
	/**
	 * notify 
	 * 
	 * @access public
	 * @return void
	 */
	function notify();
}
