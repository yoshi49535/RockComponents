<?php
require_once __DIR__.'/../Rock.php';
// Include PackageLoader
use Rock\Component\Core\Loader\PackageLoader;

$loader = new PackageLoader();
$loader->setNamespacePrefix('Rock\\Component');
$loader->loadPackageFile(__DIR__.'/all.packages');

$loader->register();
