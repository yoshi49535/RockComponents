<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
// <Namspace>
namespace Rock\Component\Http\Flow\Output;
// <Base>
use Rock\Component\Flow\Output\GraphOutput;
// @use Page Interface
use Rock\Component\Http\Flow\IPage;

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
