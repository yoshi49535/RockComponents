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

// <Namespace>
namespace Rock\Component\Http\Flow\Input;
// <Base>
use Rock\Component\Flow\Input\Input as BaseInput;
// <Interface> : For Type Safe
use Rock\Component\Http\Flow\Input\IHttpInput;
// @use Flow Direction
use Rock\Component\Flow\Directions;

/**
 *
 */
class Input extends BaseInput
  implements
    IHttpInput
{
	/**
	 *
	 */
	protected $useRedirection = false;
	/**
	 *
	 */
	protected $requestedDirection;
	/**
	 *
	 */
	public function __construct($direction, array $params = array())
	{
		$this->requestedDirection = $direction;
		if(!$direction)
			$direction = Directions::CURRENT;
		parent::__construct($direction, $params);
	}
	/**
	 *
	 */
	public function getRequestedDirection()
	{
		return $this->requestedDirection;
	}
	/**
	 *
	 */
	public function setRequestState($name)
	{
		$this->set('request_state', $name);
	}
	/**
	 *
	 */
	public function getRequestState()
	{
		return $this->get('request_state', null);
	}

	/**
	 *
	 */
	public function setRedirectionSetting($bUse)
	{
		$this->useRedirection = $bUse;
	}

	/**
	 *
	 */
	public function useRedirection()
	{
		return ($this->useRedirection && ($this->direction !== Directions::CURRENT));
	}

}
