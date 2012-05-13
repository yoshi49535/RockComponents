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
namespace Rock\Component\Automaton\Trail;
// @base
use Rock\Component\Container\Graph\Path\Path as GraphPath;
// @use Interfaces
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Automaton\IAutomaton;

/**
 *
 */
class Trail extends GraphPath
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
}
