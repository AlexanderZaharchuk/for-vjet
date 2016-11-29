<?php

namespace core\controllers;

class Controller
{
    public function render($view, $params = []) {
        extract($params);

        ob_start();
        require_once '../'.$view;
        $renderedView = ob_get_clean();

        echo $renderedView;
    }
}