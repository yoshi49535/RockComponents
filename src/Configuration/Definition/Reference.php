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

