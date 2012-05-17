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
namespace Rock\Component\Web\Flow\IO;
// @extends 
use Rock\Component\Flow\IO\Output as BaseOutput;
// @use Page Interface
use Rock\Component\Web\Flow\Path\State\IPage;

/**
 * 
 */
class Output extends BaseOutput
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
	 * setRedirectTo 
	 * 
	 * @param IPage $page 
	 * @access public
	 * @return void
	 */
	public function setRedirectTo(IPage $page)
	{
		$this->redirectTo   = $page;
	}

	/**
	 * getRedirectTo 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRedirectTo()
	{
		return $this->needRedirect() ?
			$this->redirectTo : 
			null;
	}

	/**
	 * hasRedirectTo 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasRedirectTo()
	{
		return !is_null($this->redirectTo);
	}

	/**
	 * needRedirect 
	 * 
	 * @access public
	 * @return void
	 */
	public function needRedirect()
	{
		return ($this->isSuccess() && (!is_null($this->redirectTo)));
	}
}
