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

namespace Rock\Components\Flow\Output;

// <Interface>
use Rock\Components\Container\Graph\IGraphTrail;
// <Use>
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Container\Graph\Path\IPath as ITrail;


class GraphOutput extends Output
  implements 
    IGraphTrail
{
	protected $trail;

	/**
	 *
	 */
	public function __construct(IInput $input, ITrail $trail= null, $params = array())
	{
		parent::__construct($input, $params);

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
