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
namespace Rock\Components\Core\Loader;

if(!class_exists('Rock\Components\Core\Rock'))
{
	require_once(__DIR__.'/../Rock.php');
}

// <Use>
use Rock\Components\Core\Loader\File\PackageFile;

class PackageLoader
{
	private $prefix     = '';
    private $namespaces = array();


	public function setNamespacePrefix($prefix)
	{
		$this->prefix  = $prefix;
	}
	public function loadPackageFile($filepath)
	{
		$file = new PackageFile($filepath);

		$pkg = $file->getPackages();
		$this->registerNamespaces($file->getPackages());
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
		  return str_replace('\\', DIRECTORY_SEPARATOR, $subNs);
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
