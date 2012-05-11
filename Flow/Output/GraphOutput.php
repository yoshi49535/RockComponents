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
