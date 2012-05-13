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
namespace Rock\Component\Automaton;
// @extends 
use Rock\Component\Automaton\Automaton;

/**
 *
 */
class FiniteAutomaton extends Automaton
{
	/**
	 * getEndPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEndPoint()
	{
		$vertices = $this->getGraph()->getVertices();
		foreach($vertices as $vertex)
		{
			if(0 === $this->getGraph()->getOutDegreeOf($vertex))
			{
				$endpoints[]  = $vertex;
			}
		}
		return $endpoints;
	}
}
