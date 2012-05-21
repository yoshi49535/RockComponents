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

use Rock\Component\Web\Page\IPage;


/**
 * PageStack 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class PageStack
{
	protected $pages;
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->pages = array();
	}
	
	/**
	 * top 
	 * 
	 * @access public
	 * @return void
	 */
	public function top()
	{
		return $this->pages[count($this->pages) - 1];
	}

	/**
	 * push 
	 * 
	 * @param IPage $page 
	 * @access public
	 * @return void
	 */
	public function push(IPage $page)
	{
		array_push($this->pages, $page);
	}

	/**
	 * pop 
	 * 
	 * @access public
	 * @return void
	 */
	public function pop()
	{
		return array_pop($this->pages);
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->pages);
	}
}
