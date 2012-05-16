<?php
require_once __DIR__.'/../../../Core/Rock.php';

use Rock\Component\Core\Loader\PackageLoader;

$loader  = new PackageLoader();
$loader->setNamespacePrefix('Rock\\Component');
$loader->loadPackageFile(__DIR__.'/packages');
$loader->register();

spl_autoload_register(function($class)
{
    if (0 === strpos($class, 'Rock\\Component\\Web\\Flow\\Tests') &&
        file_exists($file = __DIR__.'/'.implode('/', array_slice(explode('\\', $class), 5)).'.php')) {
        require_once $file;
    }
});
