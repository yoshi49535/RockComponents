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
namespace Rock\Component\Flow\Type;

// <Use> : Factory
use Rock\Component\Flow\Factory\IFactory;

/**
 *
 */
interface IType
{
	/**
	 *
	 */
	public function isSupport($type);

	/** 
	 *
	 */
	public function getFlowTemplates();

	/**
	 *
	 */
	public function getBuilderClass();
}
