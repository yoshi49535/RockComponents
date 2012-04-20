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
namespace Rock\Componets\Automaton\Input;

interface IInput
{
	/**
	 *
	 */
	public function getDirection();

	/**
	 *
	 */
	public function getValue();
}
