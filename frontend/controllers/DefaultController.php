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
        $result = $this->mysqli->query("SELECT * FROM posts ORDER BY created_at DESC");
        $records = $this->readAllRecords($result, true);

        $top = $this->mysqli->query("SELECT * FROM posts ORDER BY comments DESC LIMIT 5");
        $topResult = $this->readAllRecords($top, true);

        $this->render('views/index.php', [
            'records' => $records,
            'topResult' => $topResult
        ]);
    }
    
    public function actionView()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $review = $this->mysqli->query("SELECT * FROM posts WHERE id = '$id'")->fetch_assoc();

        $result = $this->mysqli->query("SELECT * FROM posts RIGHT JOIN reviews ON posts.id = reviews.post_id WHERE id = '$id'");

        $result = $this->readAllRecords($result);

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

        $successful = $this->mysqli->query("INSERT INTO posts (autor, text, created_at) VALUES ('$name', '$text', $created_at)");

        if ($successful) {
            $this->redirect('/frontend/default/index');
        } else {
            $this->redirect('/frontend/default/error');
        }
    }

    public function readAllRecords($rows, $limiter = false)
    {
        $result = [];
        while (false != $record = $rows->fetch_assoc()) {
            (isset($record['text']) && $limiter) ? $record['text'] = $this->getNiceSubStr($record['text'], 100)."..." : null;
            $result[] = $record;
        }

        return $result;
    }

    function getNiceSubStr($str, $len, $chr = ' ')
    {
        $str .= ' ';
        return mb_substr($str, 0, mb_strpos($str, $chr, mb_strlen($str) < $len ? mb_strlen($str) - 1 : $len));
    }
}
