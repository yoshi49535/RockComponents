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
namespace Rock\Component\Http\Flow\Output;
// <Base>
use Rock\Component\Flow\Output\GraphOutput;

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
