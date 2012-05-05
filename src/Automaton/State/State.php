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

namespace Rock\Component\Automaton\State;

use Rock\Component\Container\Graph\Vertex\Vertex;

class State extends Vertex
  implements
    IState
{
	protected $isEntryPoint;

	/**
	 *
	 */
	public function isEndPoint($isEndPoint = null)
	{
		return (0 === $this->getGraph()->getOutDegreeOf($this));
	}
	/**
	 *
	 */
	public function isEntryPoint($isEntryPoint = null)
	{
		if(null !== $isEntryPoint)
		{
			$this->isEntryPoint  = (bool)$isEntryPoint;
		}
		return $this->isEntryPoint;
	}
}
