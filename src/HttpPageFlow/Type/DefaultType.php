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
namespace Rock\Component\Http\Flow\Type;
// <Base>
use Rock\Component\Flow\Type\DefaultType as BaseType;
// <Use> : Builder
use Rock\Component\Http\Flow\Builder\Builder;
use Rock\Component\Flow\Factory\IFactory;

/**
 *
 */
class DefaultType extends BaseType
{
	/** 
	 *
	 */
	public function getFlowTemplates()
	{
		return array('default' => 'Rock\\Component\\Http\\Flow\\PageFlow');
	}
	/** 
	 *
	 */
	public function getBuilderClass()
	{
		return 'Rock\\Component\\Http\\Flow\\Builder\\Builder';
	}
}
