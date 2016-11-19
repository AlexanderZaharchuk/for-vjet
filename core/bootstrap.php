<?php

require_once 'routes/Route.php';
require_once 'helpers/UrlParserHelper.php';

use core\routes\Route;

$route = new Route();


//
//if ($handle = opendir($dir)) {
//    while (false !== ($file = readdir($handle))) {
//        print_r($file."<br />");
//    }
//    closedir($handle);
//}
//
//spl_autoload_register(function ($class) {
//    include 'classes/' . $class . '.class.php';
//});
