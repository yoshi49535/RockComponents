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
	/**
	 * pages 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $pages = array();

	/**
	 * observers 
	 * 
	 * @var array
	 * @access private
	 */
	private $observers = array();

	
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
		
		$this->notifyAll();
	}

	/**
	 * pop 
	 * 
	 * @access public
	 * @return void
	 */
	public function pop()
	{
		$poped = array_pop($this->pages);

		$this->notifyAll();
		return $poped;
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


	public function addObserver(IPageStackObserver $observer)
	{
		$this->observers[]  = $observer;
	}

	public function removeObserver(IPageStackObserver $observer)
	{
		if(false !== ($index = array_search($observer, $this->observers)))
			unset($this->observers[$index]);
	}

	public function notifyAll()
	{
		foreach($this->observers as $observer)
			$observer->notify();
	}
}
