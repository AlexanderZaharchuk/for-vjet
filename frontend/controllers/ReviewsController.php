<?php

namespace frontend\controllers;

use core\controllers\Controller;

class ReviewsController extends Controller
{
    public function actionCreate()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $autor_reviewer = isset($_POST['autor_reviewer']) ? $this->mysqli->real_escape_string($_POST['autor_reviewer']) : null;
        $text_reviewer = isset($_POST['text_reviewer']) ? $this->mysqli->real_escape_string($_POST['text_reviewer']) : null;

        $successful1 = $this->mysqli->query("INSERT INTO reviews (post_id, autor_reviewer, text_reviewer) VALUES ('$id', '$autor_reviewer', '$text_reviewer')");
        $successful2 = $this->mysqli->query("UPDATE posts SET comments = comments + 1 WHERE id = '$id'");

        if ($successful1 && $successful2) {
            $this->redirect('/frontend/default/view?id='.$id);
        } else {
            $this->redirect('/frontend/default/error');
        }
    }
}
