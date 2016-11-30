<?php

namespace frontend\controllers;

use core\controllers\Controller;
use frontend\helpers\CommonHelper;
use frontend\models\DefaultModel;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $model = new DefaultModel();

        $result = $model->getAllPosts();
        $records = CommonHelper::readAllRecords($result, true);

        $top = $model->getTopReviews();
        $topResult = CommonHelper::readAllRecords($top, true);

        $this->render('views/index.php', [
            'records' => $records,
            'topResult' => $topResult
        ]);
    }
    
    public function actionView()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $model = new DefaultModel();

        $review = $model->getUserById($id);

        $result = $model->getAllCommentsById($id);

        $result = CommonHelper::readAllRecords($result);

        $this->render('views/view.php', [
            'review' => $review,
            'record' => $result,
        ]);
    }

    public function actionCreate()
    {
        $name = isset($_POST['name']) ? $this->mysqli->real_escape_string($_POST['name']) : null;
        $text = isset($_POST['text']) ? $this->mysqli->real_escape_string($_POST['text']) : null;
        $created_at = time();

        $model = new DefaultModel();

        $successful = $model->createPost($name, $text, $created_at);

        if ($successful) {
            $this->redirect('/frontend/default/index');
        } else {
            $this->redirect('/frontend/default/error');
        }
    }
}
