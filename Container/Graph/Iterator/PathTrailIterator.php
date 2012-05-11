<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/

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
		$this->array = &$path->getComponentByRef();
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
