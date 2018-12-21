<?php

class Db
{

    private $_connection;

    //The single instance
    private static $_instance;
    //Attributes of connection from _config/config.php
    private $_host = DATABASE_HOST;
    private $_username = DATABASE_USER;
    private $_password = DATABASE_PASSWORD;
    private $_database = DATABASE_NAME;


    /*
      Get an instance of the Database
      @return Instance
      */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct()
    {
        try {
            $this->_connection  = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
            /*** echo a message saying we have connected ***/
            // echo 'Connected to database';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    //Le clone de méthode magique est vide pour éviter la duplication de connexion
    private function __clone()
    {
    }
    // Get mysql pdo connection
    public function getConnection()
    {
        return $this->_connection;
    }

}