<?php

namespace core\db;

use mysqli;

/**
 * Class Db
 */
class Db
{
    /**
     * @var mysqli
     */
    private $_connection;

    /**
     * Singleton instance of class
     * @var
     */
    private static $_instance;

    /**
     * @var string
     */
    private $_host = "localhost";

    /**
     * @var string
     */
    private $_username = "root";

    /**
     * @var string
     */
    private $_password = "";

    /**
     * @var string
     */
    private $_database = "mvc-framework";
    
    /**
     * Db constructor.
     */
    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        $this->_connection->set_charset("utf8");

        if(mysqli_connect_error()) {
            trigger_error("Failed connect to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }
    
    /**
     * Singleton class
     * @return Db
     */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->_connection;
    }
    
    /**
     * Prevents clone singleton instance
     */
    private function __clone() { }
}
