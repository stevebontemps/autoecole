<?php

class Db
{

    private static $instance = NULL;
    function __construct(){}
    function __clone(){}
    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            //$pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=autoecole_db','root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        return self::$instance;
    }





}