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
// <Namspace>
namespace Rock\Components\Http\Flow\Output;
// <Base>
use Rock\Components\Flow\Output\GraphOutput;

/**
 * 
 */
class Output extends GraphOutput
{
	protected $bUseRedirection = false;
	public function setUseRedirection($bUse)
	{
		$this->bUseRedirection = $bUse;
	}
	public function useRedirection()
	{
		return $this->bUseRedirection;
	}
}
