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

/**
 *
 */
class Reference
{
	/** 
	 * @var string Id of the reference target
	 */
	protected $id;
	/** 
	 * @var string Scope of where the referenced instance is created
	 */
	protected $scope;

	/** 
	 *
	 */
	public function __construct($id)
	{
		$this->id         = $id;
		$this->scope      = false;
	}

	public function getId()
	{
		return $this->id;
	}
}

