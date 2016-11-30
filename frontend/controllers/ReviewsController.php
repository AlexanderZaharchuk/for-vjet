<?php

namespace frontend\controllers;

use core\controllers\Controller;
use frontend\models\ReviewsModel;

class ReviewsController extends Controller
{
    public function actionCreate()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $autor_reviewer = isset($_POST['autor_reviewer']) ? $this->mysqli->real_escape_string($_POST['autor_reviewer']) : null;
        $text_reviewer = isset($_POST['text_reviewer']) ? $this->mysqli->real_escape_string($_POST['text_reviewer']) : null;

        $model = new ReviewsModel();

        $successful1 = $model->insertIntoReviews($id, $autor_reviewer, $text_reviewer);
        $successful2 = $model->incrementComment($id);

        if ($successful1 && $successful2) {
            $this->redirect('/frontend/default/view?id='.$id);
        } else {
            $this->redirect('/frontend/default/error');
        }
    }
}
