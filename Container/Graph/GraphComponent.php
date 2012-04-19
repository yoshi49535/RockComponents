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
namespace Rock\Componets\Container\Graph;


// <Interface>
use Rock\Componets\Container\Graph\IGraphComponent;

// <Use>
use Rock\Componets\Container\Graph\IGraph;

//class GraphComponent extends ContainerComponent
class GraphComponent
  implements
    IGraphComponent
{
	protected $graph;
	
	/**
	 *
	 */
	public function __construct(IGraph $graph = null)
	{
		$this->graph = $graph;
	}
	/**
	 *
	 */
	public function getGraph()
	{
		return $this->graph;
	}
	/**
	 *
	 */
	public function setGraph(IGraph $graph)
	{
		$this->graph  = $graph;
	}
}
