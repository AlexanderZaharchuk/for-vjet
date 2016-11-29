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
        $result = $this->mysqli->query("SELECT * FROM posts");
        $records = $this->readAllRecords($result);
        
        $this->render('views/index.php', [
            'records' => $records
        ]);
    }

    public function actionCreate()
    {
        $name = isset($_POST['name']) ? $this->mysqli->real_escape_string($_POST['name']) : null;
        $text = isset($_POST['text']) ? $this->mysqli->real_escape_string($_POST['text']) : null;
        $created_at = time();

        $this->mysqli->query("INSERT INTO posts (autor, text, created_at) VALUES ('$name', '$text', $created_at)");

        $this->redirect('/frontend/default/index');
    }

    public function readAllRecords($rows)
    {
        $result = [];
        foreach ($rows as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
}
