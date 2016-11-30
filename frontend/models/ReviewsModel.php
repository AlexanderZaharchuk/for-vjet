<?php

namespace frontend\models;

use core\models\Model;

/**
 * Class HelloWorld
 * @package frontend\models
 */
class ReviewsModel extends Model
{
    public function insertIntoReviews($id, $autor_reviewer, $text_reviewer)
    {
        return $this->mysqli->query("INSERT INTO reviews (post_id, autor_reviewer, text_reviewer) VALUES ('$id', '$autor_reviewer', '$text_reviewer')");
    }

    public function incrementComment($id)
    {
        return $this->mysqli->query("UPDATE posts SET comments = comments + 1 WHERE id = '$id'");
    }
}
