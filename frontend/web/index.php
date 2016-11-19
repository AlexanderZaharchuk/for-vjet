<?php
error_reporting(E_ALL);
require_once '../../core/bootstrap.php';
require_once '../models/HelloWorld.php';

function vd($var, $stop = true) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($stop) {
        die;
    }
}
