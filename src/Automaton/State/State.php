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
