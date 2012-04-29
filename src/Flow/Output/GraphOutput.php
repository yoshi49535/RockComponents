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

namespace Rock\Component\Flow\Output;

// <Interface>
use Rock\Component\Container\Graph\IGraphTrail;
// <Use>
use Rock\Component\Flow\Input\IInput;
use Rock\Component\Container\Graph\Path\IPath as ITrail;


class GraphOutput extends Output
  implements 
    IGraphTrail
{
	/**
	 * Trail of this execution.
	 *
	 */
	protected $trail;

	/**
	 *
	 */
	public function __construct(ITrail $trail= null, $params = array())
	{
		parent::__construct($params);

		$this->trail = $trail;
	}
	/**
	 *
	 */
	public function setTrail(ITrail $trail)
	{
		$this->trail = $trail;
	}
	/**
	 *
	 */
	public function getTrail()
	{
		return $this->trail;
	}
}
