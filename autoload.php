<?php
require_once __DIR__.'/src/Core/Rock.php';

use Rock\Components\Core\Loader\PackageLoader;

$loader = new PackageLoader();

$loader->setNamespacePrefix('Rock\\Components');
$loader->loadPackageFile(__DIR__.'/all.packages');

$loader->register();
