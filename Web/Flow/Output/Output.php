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

// <Namspace>
namespace Rock\Component\Web\Flow\Output;
// <Base>
use Rock\Component\Flow\Output\GraphOutput;
// @use Page Interface
use Rock\Component\Web\Flow\IPage;

/**
 * 
 */
class Output extends GraphOutput
{
	/**
	 *
	 */
	protected $redirectTo    = null;

	/**
	 *
	 */
	public function isStopRedirect()
	{
		return !$this->isSuccess();
	}
	/**
	 *
	 */
	public function setRedirectTo(IPage $page)
	{
		$this->redirectTo   = $page;
	}

	/**
	 *
	 */
	public function getRedirectTo()
	{
		return $this->needRedirect() ?
			$this->redirectTo : 
			null;
	}

	public function hasRedirectTo()
	{
		return !is_null($this->redirectTo);
	}
	/**
	 *
	 */
	public function needRedirect()
	{
		return ($this->isSuccess() && (!is_null($this->redirectTo)));
	}
}
