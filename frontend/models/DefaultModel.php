<?php

namespace frontend\models;
use core\models\Model;

/**
 * Class HelloWorld
 * @package frontend\models
 */
class DefaultModel extends Model
{
    public function getAllPosts()
    {
        return $this->mysqli->query("SELECT * FROM posts ORDER BY created_at DESC");
    }
    
    public function getTopReviews()
    {
        return $this->mysqli->query("SELECT * FROM posts ORDER BY comments DESC LIMIT 5");
    }
    
    public function getUserById($id)
    {
        return $this->mysqli->query("SELECT * FROM posts WHERE id = '$id'")->fetch_assoc();
    }
    
    public function getAllCommentsById($id)
    {
        return $this->mysqli->query("SELECT * FROM posts RIGHT JOIN reviews ON posts.id = reviews.post_id WHERE id = '$id'");
    }
    
    public function createPost($name, $text, $created_at)
    {
        return $this->mysqli->query("INSERT INTO posts (autor, text, created_at) VALUES ('$name', '$text', $created_at)");
    }
}
