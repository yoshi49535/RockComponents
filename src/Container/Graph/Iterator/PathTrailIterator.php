<?php
/************************************************************************************
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/

class PathTrailIterator 
  implements
    \Iterator,
	\Traversable,
	\SeekableIterator,
	\Countable,
	\Serializable 
{
	protected $path;
	protected $array;
	
	/**
	 *
	 */
	public function __construct(IPath)
	{
		$this->path  = $path;
		$this->array = &$path->getComponentsByRef();
	}
	/**
	 *
	 */
	public function current()
	{
		return $this->array[$this->pos];
	}
	/**
	 *
	 */
	public function next()
	{
		++$this->pos;
	}
	/**
	 *
	 */
	public function previous()
	{
		--$this->pos;
	}
	/**
	 *
	 */
	public function hasNext()
	{
	}
	/**
	 *
	 */
	public function valid()
	{
		return (0 =< $this->pos) && ($this->pos < count($this->array));
	}

}
