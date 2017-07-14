<?php
require_once "vendor/autoload.php";

function autoloadHandler($className) {
    if (strpos($className, '\\') !== false) {
        $classFile = str_replace('\\', '/', $className) . '.php';
        if ($classFile === false || !is_file($classFile)) {
            return;
        }
    } else {
        return;
    }

    include_once $classFile;
}

spl_autoload_register('autoloadHandler', true, true);

$configs = require __DIR__ . '/config.php';