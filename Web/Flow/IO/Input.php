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
namespace Rock\Component\Web\Flow\IO;
// <Base>
use Rock\Component\Flow\IO\Input as BaseInput;
// <Interface> : For Type Safe
use Rock\Component\Web\Flow\IO\IHttpInput;
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
	protected $useRedirection = true;
	
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


		if(array_key_exists('useCleanUrl', $params) && (false === $params['useCleanUrl']))
			$this->setRedirectionSetting(false);

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
