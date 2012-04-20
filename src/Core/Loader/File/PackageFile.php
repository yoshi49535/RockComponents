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
namespace Rock\Components\Core\Loader\File;

/**
 *
 */
class PackageFile
{
	protected
	  $consts    = array(),
	  $packages  = array();

	public function __construct($path)
	{
		if(!file_exists($path))
		{
			throw new \Exception(sprintf('File "%s" is not existed.', $path));
		}
		$this->doMount($path);
	}
	
	public function getPackages()
	{
		return $this->packages;
	}

	public function getNamespaces()
	{
		return array_keys($this->packages);
	}

	protected function doMount($path)
	{
		$data  = file_get_contents($path);

		$lines = explode("\n", $data);

		$this->addConst('%DIR%', dirname($path));

		foreach($lines as $line)
		{
			if($pos = strpos($line,':'))
			{
				$ns   = trim(substr($line, 0, $pos));
				$path = trim(substr($line, $pos + 1));

				$this->packages[$ns]  = $this->replaceConstants($path);
			}
		}
	}
	
	public function addConst($key, $value)
	{
		$this->consts[$key]  = $value;
	}
	protected function replaceConstants($value)
	{

		return strtr($value, $this->consts);
	}
}
