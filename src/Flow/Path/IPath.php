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
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ************************************************************************************/

// <Namespace>
namespace Rock\Components\Flow\Path;

// <Use> : Flow Components
use Rock\Components\Flow\Step\IStep;

interface IPath 
{

	/**
	 *
	 */
	public function getSteps();

	/**
	 *
	 */
	public function getEntrySteps();

	/**
	 *
	 */
	public function getNextSteps(IStep $step);

	/**
	 *
	 */
	public function getPrevSteps(IStep $step);

	/**
	 *
	 */
	public function countSteps();
}
