<?php

require_once __DIR__.'/../autoload.php';

spl_autoload_register(function($class)
{
    if (0 === strpos($class, 'Rock\\ComponentTests\\Tests') &&
        file_exists($file = __DIR__.'/Tests/'.implode('/', array_slice(explode('\\', $class), 3)).'.php')) {
        require_once $file;
    }
});
