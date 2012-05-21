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

// @namespace
namespace Rock\Component\Automaton\Graph\Path;
// @extends
use Rock\Component\Container\Graph\Path\Path as GraphPath;
// @use Interfaces
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Automaton\IAutomaton;
// @use Path Component
use Rock\Component\Automaton\Path\Trail\ITrail;
use Rock\Component\Automaton\Path\IComponent as IPathComponent;

/**
 *
 */
class Trail extends GraphPath
  implements
    ITrail
{
	/**
	 * __construct 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	public function __construct(IGraph $graph)
	{
		parent::__construct($graph);

	}

	/**
	 * getPath 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPath()
	{
		return $this->getGraph();
	}

	/**
	 * first 
	 * 
	 * @access public
	 * @return void
	 */
	public function first()
	{
		return parent::first();
	}
	
	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	public function last()
	{
		return parent::last();
	}

	/**
	 * unpack 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function unpack(array $data = array())
	{
		try
		{
			parent::unpack($data);
		}
		catch(\Exception $ex)
		{
			if($this->getGraph()->isHandleException())
				throw $ex;

			// Otherwise, initialize component as empty
			$this->components = array();
		}
	}

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
	}

	/**
	 * unserialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function unserialize($data)
	{
	}
}
