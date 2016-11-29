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
        $result = $this->mysqli->query("SELECT * FROM posts ORDER BY created_at");
        $records = $this->readAllRecords($result);

        $this->render('views/index.php', [
            'records' => $records
        ]);
    }
    
    public function actionView()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $result = $this->mysqli->query("SELECT * FROM posts WHERE id = '$id'")->fetch_assoc();

        $this->render('views/view.php', [
            'record' => $result
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
        while (false != $record = $rows->fetch_assoc()) {
            (isset($record['text'])) ? $record['text'] = $this->getNiceSubStr($record['text'], 100)."..." : null;
            $result[] = $record;
        }

        return $result;
    }

    function getNiceSubStr($str, $len, $chr = ' ')
    {
        return mb_substr($str, 0, mb_strpos($str, $chr, $len));
    }
}
