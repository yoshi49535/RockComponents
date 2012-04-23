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
// <Namespace>
namespace Rock\Components\Flow;
// <Use>
use Rock\Components\Flow\Input\IInput;

/**
 *
 */
interface IFlowComponent
{

	/**
	 *
	 */
	public function getFlow();

	/**
	 *
	 */
	public function handle(IInput $input);
}
