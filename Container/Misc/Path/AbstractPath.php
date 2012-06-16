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
namespace Rock\Component\Container\Misc\Path;
//
use Rock\Component\Container\IContainer;


/**
 * AbstractPath 
 * 
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class AbstractPath
  implements
    IPath,
    \IteratorAggregate,
	\Countable
{
	private $container;
	private $components;

	/**
	 * __construct 
	 * 
	 * @param IContainer $container 
	 * @access public
	 * @return void
	 */
	public function __construct(IContainer $container)
	{
		$this->container  = $container;
		$this->components = array();
	}
	/**
	 * setContainer 
	 * 
	 * @param IContainer $container 
	 * @access protected
	 * @return void
	 */
	protected function setContainer(IContainer $container)
	{
		$this->container = $container;
	}

	/**
	 * getContainer 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContainer()
	{
		return $this->container;
	}
	
	/**
	 * getComponents 
	 * 
	 * @access public
	 * @return void
	 */
	public function getComponents()
	{
		return $this->components;
	}
	public function setComponents($components)
	{
		$this->components = $components;
	}

	/**
	 * getComponentByRef
	 * 
	 * @access protected
	 * @return void
	 */
	protected function & getComponentsByRef()
	{
		return $this->components;
	}
	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->components);
	}
	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->components);
	}
	///**
	// *
	// */
	//public function countVertices()
	//{
	//	return count();
	//}
	/**
	 *
	 */
	public function first()
	{
		if(count($this->components) <= 0)
		{
			throw new \Exception('Component is empty');
		}
		$itr = new \ArrayIterator($this->components);
		$itr->rewind();
		return $itr;
	}

	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	public function last()
	{
		if(count($this->components) <= 0)
		{
			throw new \Exception('Component is empty');
		}
		$itr = new \ArrayIterator($this->components);
		$itr->seek(count($this->components) - 1);
		return $itr;
	}

	/**
	 * merge 
	 * 
	 * @param IPath $path 
	 * @access public
	 * @return void
	 */
	public function merge(IPath $path)
	{
		if($path->count() === 0)
		{
			// do not merge any
			return ;
		}
		else if($this->count() === 0)
		{
			// copy all components from path
			$this->components  = $path->getComponents();
		}
		else
		{
			$srcItr  = $path->first();
			$trgItr  = $this->last();

			if(!$srcItr->valid() || !$trgItr->valid())
			{
				throw new \Exception('Invalid state iterator');
			}
			else if($srcItr->current() === $trgItr->current())
			{
				$srcItr->next();
				while($srcItr->valid())
				{
					$this->pushComponent($srcItr->current());
					$srcItr->next();
				}
			}
			else
			{
				throw new \InvalidArgumentException('The end component of Source and the first component of Target is difference.' );
			}
		}
	}


	/**
	 * pushComponent 
	 * 
	 * @param mixed $component 
	 * @access protected
	 * @return void
	 */
	protected function pushComponent($component)
	{
		array_push($this->components, $component);
	}

	/**
	 * enqueComponent 
	 * 
	 * @param mixed $component 
	 * @access protected
	 * @return void
	 */
	protected function enqueComponent($component)
	{
		array_unshift($this->components, $component);
	}
	/**
	 * popComponent 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function popComponent()
	{
		return array_pop($this->components);
	}

	
	/**
	 * popAll 
	 * 
	 * @access public
	 * @return void
	 */
	public function popAll()
	{
		$this->components = array();
	}
}
