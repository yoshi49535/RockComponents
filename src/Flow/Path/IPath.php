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
namespace Rock\Component\Flow\Path;

// <Use> : Flow Component
use Rock\Component\Flow\Step\IStep;

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
