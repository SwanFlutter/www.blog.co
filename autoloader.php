<?php

function classAutoloader($className)
{
    $className = trim($className, '\\');
    $classNameArray = explode('\\', $className);

    if (count($classNameArray) < 2) {
        return;
    }

    $namespace = $classNameArray[0];
    $className = $classNameArray[1];

    $baseDir = __DIR__ . DIRECTORY_SEPARATOR;

    switch ($namespace) {
        case 'Controllers':
            $filePath = $baseDir . 'Controllers' . DIRECTORY_SEPARATOR . $className . '.php';
            break;
        case 'Traits':
            $filePath = $baseDir . 'Traits' . DIRECTORY_SEPARATOR . $className . '.php';
            break;
        default:
            return;
    }

    if (file_exists($filePath)) {
        include_once $filePath;
    }
}

spl_autoload_register("classAutoloader");
