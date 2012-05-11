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

// <BaseClass>
use Rock\Component\Automaton\State\State;
// <Interface>
use Rock\Component\Container\Graph\Vertex\INamedVertex;
// <Use>
use Rock\Component\Container\Graph\IGraph;

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
