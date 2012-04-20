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

// <Use>
use Rock\Components\Flow\Input\IInput;
use Rock\Components\Container\Graph\Path\IPath;
use Rock\Components\Container\Graph\IGraphTrail;

class GraphOutput extends Output
  implements 
    IGraphTrail
{
	protected $path;

	/**
	 *
	 */
	public function __construct(IInput $input, IPath $path = null, $params = array())
	{
		parent::__construct($input, $params);

		$this->path  = $path;
	}
	/**
	 *
	 */
	public function setPath(IPath $path)
	{
		$this->path  = $path;
	}
	/**
	 *
	 */
	public function getPath()
	{
		return $this->path;
	}
}
