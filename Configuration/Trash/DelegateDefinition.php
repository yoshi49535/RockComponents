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
// @namespace
namespace Rock\Component\Configuration\Definition;
// @use
use Rock\Component\Configuration\Definition\Reference;

/**
 * DelegateDefinition 
 * 
 * @uses InScopeDefinition
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class DelegateDefinition extends Definition
{
	public function __construct($id, $attributes = array())
	{
		parent::__construct($id, $attributes);

		$this->class = '\\Rock\\Component\\Utility\\Delegate\\Delegate';
		
	}
}
