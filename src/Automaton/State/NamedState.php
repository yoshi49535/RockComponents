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

namespace Rock\Componets\Automaton\State;

// <BaseClass>
use Rock\Componets\Automaton\State\State;
// <Interface>
use Rock\Componets\Container\Graph\Vertex\INamedVertex;
// <Use>
use Rock\Componets\Container\Graph\IGraph;

class NamedState extends State
  implements
    INamedVertex
{
	protected $name;

	public function __construct(IGraph $graph, $name)
	{
		parent::__construct($graph);

		$this->name  = $name;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name  = $name;
	}
}
