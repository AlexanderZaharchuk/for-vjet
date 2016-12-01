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
    /**
     * Page last records action
     */
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

    /**
     * Page record action
     */
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

    /**
     * Creating a record action
     */
    public function actionCreate()
    {
        $model = new DefaultModel();

        $name = isset($_POST['name']) ? $model->mysqli->real_escape_string($_POST['name']) : null;
        $text = isset($_POST['text']) ? $model->mysqli->real_escape_string($_POST['text']) : null;
        $created_at = time();
        
        $successful = $model->createPost($name, $text, $created_at);

        if ($successful) {
            $this->redirect('/frontend/default/index');
        } else {
            $this->redirect('/frontend/default/error');
        }
    }
}
