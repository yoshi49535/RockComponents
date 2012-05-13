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
namespace Rock\Component\Debug;

class Variable
{
	static public function dump($var)
	{
		$dump  = '';
		if($var)
		{
			// php 5.3.3 has some bugs on var_dump w/ recursive point object. 
			//ob_start();
			//var_dump($var);
			//$dump = ob_get_contents();
			//ob_clean_end();

			$dump = implode("\n", self::doRecursive($var));
		}

		return (string)$dump;
	}

	static protected function doRecursive($var)
	{
		$logs  = array();
		switch($var)
		{
		case is_array($var):
			$logs[]  = 'Array{';
			foreach($var as $key => $value)
			{
				$logs[] = $key.' : ';
				$logs   = array_merge($logs, self::doRecursive($value));
			}
			$logs[]  = '}';
			break;
		case is_object($var):
			$logs[]  = 'Object : '.get_class($var);
			break;
		default:
			$logs[]  = print_r($var, true);
			break;
		}

		return $logs;
	}
}
