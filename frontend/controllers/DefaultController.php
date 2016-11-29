<?php

namespace frontend\controllers;

use core\controllers\Controller;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->render('views/index.php', [
            'test' => 'test1111'
        ]);
    }
}
