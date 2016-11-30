<?php

namespace core\models;

use core\db\Db;

class Model
{
    public $mysqli;
    
    public function __construct()
    {
        $db = Db::getInstance();
        $this->mysqli = $db->getConnection();
    }
}
