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

namespace Rock\Component\Container\Graph\Builder;

class SimpleBuilder extends Builder
{
	public function __construct()
	{
		$this->nodeFactory  = new GraphNodeFactory();
		$this->edgeHolder = new GraphLinkedEdgeHolder();
		$this->edgeFactory = new GraphEdgeFactory();
	}
}
