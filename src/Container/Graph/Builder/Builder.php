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

namespace Rock\Components\Container\Graph\Builder;

class Builder
  implements IGraphBuilder
{
	public function build()
	{
		$graph	= $this->getFactory()->create();

		$graph->setNodeFactory($this->getNodeFacotry());
		$graph->setEdgeHolder($this->getEdgeHolder());
		$graph->setEdgeFactory($this->getEdgeFactory());
	}

	/**
	 * The Class 
	 */
	public function getEdgeHolder(IEdgeHolder $holder)
	{
		return $this->edgeHolder;
	}
}
