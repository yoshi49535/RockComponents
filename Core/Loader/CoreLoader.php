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

defined('DIRECTORY_SEPARATOR') or define('DIRECTORY_SEPARATOR', '/');

class CoreLoader
{
	const CORE_NS  = 'Rock\\Component\\Core';

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

			$ns   = self::CORE_NS;
			{
				if(false == $subNs = $this->getSubNamespace($namespace, $ns)) {
					return;
				}

				$dir  = __DIR__.'/..';
                {
                    $className = substr($class, $pos + 1);
                    $file = $dir.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $subNs).DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';

                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }

        }
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

$loader = new CoreLoader();
$loader->register();
