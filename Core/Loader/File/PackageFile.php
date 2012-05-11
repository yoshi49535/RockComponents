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

// <Namespace>
namespace Rock\Component\Core\Loader\File;

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
		$pkgs  = $this->packages;
		foreach($pkgs as $key => $path)
		{
			$pkgs[$key]  = $this->replaceConstants($path);
		}
		return $pkgs;
	}

	public function getNamespaces()
	{
		return array_keys($this->packages);
	}

	protected function doMount($path)
	{
		$data  = file_get_contents($path);

		$lines = explode("\n", $data);

		$this->setConst('%DIR%', dirname($path));

		foreach($lines as $line)
		{
			if($pos = strpos($line,':'))
			{
				$ns   = trim(substr($line, 0, $pos));
				$path = trim(substr($line, $pos + 1));

				//$this->packages[$ns]  = $this->replaceConstants($path);
				$this->packages[$ns]  = $path;
			}
		}
	}
	
	public function setConst($key, $value)
	{
		$this->consts[$key]  = $value;
	}
	protected function replaceConstants($value)
	{
		return strtr($value, $this->consts);
	}
}
