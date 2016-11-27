<?php
spl_autoload_register(function ($class) {
    $path = explode('\\', $class);
    array_shift($path);
    $path = implode('/', $path).'.php';
    require_once $path;
});
