<?php

namespace core\controllers;

use core\db\Db;

class Controller
{
    public $mysqli;
    
    public function __construct()
    {
        $db = Db::getInstance();
        $this->mysqli = $db->getConnection();
    }

    public function render($view, $params = []) {
        extract($params);

        ob_start();
        require_once '../'.$view;
        $renderedView = ob_get_clean();

        echo $renderedView;
    }
    
    public function redirect($url)
    {
        header("Location: $url");
    }

    public function refresh()
    {
        $page = $_SERVER['PHP_SELF'];
        $sec = "10";
        header("Refresh: $sec; url=$page");
    }

    public function actionError()
    {
        $this->render('views/error.php');
    }
}
