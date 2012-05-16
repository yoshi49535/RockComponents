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
// @namespace
namespace Rock\Component\Web\Flow\Session;

/**
 * Session 
 * 
 * @uses BaseSession
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Session extends BaseSession
{
	/**
	 * validate 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function validate()
	{
		// has to have 'id'

		return true;
	}
}
