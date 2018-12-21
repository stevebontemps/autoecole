<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 13/12/18
 * Time: 17:09
 */

class ModelsAutoloader
{
    //register des require
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    //function qui definie les require
    static function autoload($class){
        // soit require soit require_once en fonction du besoin du Chargement de la Class
        require_once('./models/' . $class . '.php');
    }
}