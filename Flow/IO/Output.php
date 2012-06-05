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
// @namespace
namespace Rock\Component\Flow\IO;
// @extends
use Rock\Component\Automaton\IO\Output as BaseOutput;
// @interface
use Rock\Component\Flow\IO\IInput;
// @use Flow
use Rock\Component\Flow\IFlow;

/**
 * Output 
 * 
 * @package 
 * @extends BaseOutput
 * @implement IOutput
 * @implement IParameterBag
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Output extends BaseOutput
{

	protected $bSuccess;
	/**
	 * __construct 
	 * 
	 * @param IFlow $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(IFlow $owner)
	{
		parent::__construct($owner);
	}

	/**
	 * isSuccess 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSuccess()
	{
		return $this->bSuccess;
	}

	/**
	 * success 
	 * 
	 * @access public
	 * @return void
	 */
	public function success()
	{
		$this->bSuccess = true;
	}

	/**
	 * fail 
	 * 
	 * @access public
	 * @return void
	 */
	public function fail()
	{
		$this->bSuccess = false;
	}

	//----
	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf("Flow Output:[Class='%s']", get_class($this));
	}
}
