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
namespace Rock\Component\Core\Loader;

if(!class_exists('Rock\Component\Core\Rock'))
{
	require_once(__DIR__.'/../Rock.php');
}

// <Use>
use Rock\Component\Core\Loader\File\PackageFile;

class PackageLoader
{
	private $prefix     = '';
    private $namespaces = array();
	private $pkgFile    = null;
	private $bRegisted  = false;

	public function setNamespacePrefix($prefix)
	{
		$this->prefix  = $prefix;
	}
	public function loadPackageFile($filepath)
	{
		$this->pkgFile = new PackageFile($filepath);
		//$pkg = $file->getPackages();
	}

	public function getPackageFile()
	{
		return $this->pkgFile;
	}

	public function setPackageFile(PackageFile $file)
	{
		if($this->bRegisted)
			throw new \Exception('Loader Already Registed, so cannot modify Package File.');
		$this->pkgFile = $file;
	}
    /**
     * Gets the configured namespaces.
     *
     * @return array A hash with namespaces as keys and directories as values
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }
    /**
     * Registers an array of namespaces
     *
     * @param array $namespaces An array of namespaces (namespaces as keys and locations as values)
     *
     * @api
     */
    public function registerNamespaces(array $namespaces)
    {
        foreach ($namespaces as $namespace => $locations) {
            $this->namespaces[$namespace] = (array) $locations;
        }

		// $this->checkDuplication();
    }

    /**
     * Registers a namespace.
     *
     * @param string       $namespace The namespace
     * @param array|string $paths     The location(s) of the namespace
     *
     * @api
     */
    public function registerNamespace($namespace, $paths)
    {
        $this->namespaces[$namespace] = (array) $paths;

		// $this->checkDuplication();
    }

    /**
     * Registers this instance as an autoloader.
     *
     * @param Boolean $prepend Whether to prepend the autoloader or not
     *
     * @api
     */
    public function register($prepend = false)
    {
		$this->bRegisted = true;
		$this->registerNamespaces($this->getPackageFile()->getPackages());

		// 
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);

    }

    /**
     * Loads the given class or interface.
     *
     * @param string $class The name of the class
     */
    public function loadClass($class)
    {
        if ($file = $this->findFile($class)) {
            require_once $file;
        }
    }

    /**
     * Finds the path to the file where the class is defined.
     *
     * @param string $class The name of the class
     *
     * @return string|null The path, if found
     */
    public function findFile($class)
    {
		// replace prefix slash
		$class = $this->trimNs($class);


		// last camel is the classname
        if (false !== $pos = strrpos($class, '\\')) {
            // namespaced class name
            $namespace = substr($class, 0, $pos);
            foreach ($this->namespaces as $ns => $dirs) {
				$ns  = $this->prefix.'\\'.$ns;

				if(false === $subNs = $this->getSubNamespace($namespace, $ns)) {
					continue;
				}
                foreach ($dirs as $dir) {
                    $className = substr($class, $pos + 1);
                    $file = $dir.DIRECTORY_SEPARATOR.$this->convertSubnamespaceToDir($subNs).DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }

        }
	}
	protected function convertSubnamespaceToDir($ns)
	{
		if(strlen($ns) > 0)
		  return str_replace('\\', DIRECTORY_SEPARATOR, $ns);
		return '.';
	}
	/** 
	 *
	 */
	protected function trimNs($ns)
	{
		//if('\\' == $ns[0]) {
		//	$ns  = substr($ns, 1);
		//}
		//return $ns;
		return trim($ns, '\\');
	}
	/** 
	 *
	 */
	protected function getSubNamespace($namespace, $prefix)
	{
		if(0 !== $pos = strpos($namespace, $prefix)) {
			return false;
		}

		return $this->trimNs(substr($namespace, strlen($prefix) + 1));
	}
}
