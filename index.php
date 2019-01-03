<?php

// --------------------------- //
//       ERRORS DISPLAY        //
// --------------------------- //
//!\\ A enlever lors du déploiement
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);


// --------------------------- //
//          SESSIONS           //
// --------------------------- //
// ini_set('session.cookie_lifetime', false);

session_start();
//session_destroy();
// exit();

// Inclusion des fichiers principaux
include_once '_config/config.php';
include_once '_functions/functions.php';


// On enregistre notre autoload pour les modeles.
require('models/ModelsAutoloader.php');
// on appele une methode : register de la Classe Autoloader
ModelsAutoloader::register();


//recupere instance de la connexion a la Base de Donnees
// On émet une alerte à chaque fois qu'une requête a échoué.
$db = Db::getInstance();
$db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo = $db->getConnection();


// On enregistre notre autoload pour les controlleurs.
// require('controllers/ControllersAutoloader.php');
// on appele une methode : register de la Classe Autoloader
// ControllersAutoloader::register();

require_once('controllers/FrontOfficeController.php');
require_once('controllers/BackOfficeController.php');

$frontOfficeControleur = new FrontOfficeController();
$backOfficeControleur  = new BackOfficeController();

/*
debug("Mes controlleurs : ");
debug($frontOfficeControleur);
debug($backOfficeControleur);
*/

// on initialise une DAO pour gerer les options
$optionsManager = new OptionsManager($pdo);



//Récupération de l' URL
$uri = $_SERVER['REQUEST_URI'];
$uri = substr($uri, strpos($uri, '/index.php'));
$uriTab = explode('?', $uri);
$uri = $uriTab[0];

// WEBSITE_URL vaut : http://localhost/autoecole/


//Gestion des routes
if(strcmp($uri, '') == 0){
    $frontOfficeControleur->afficherPageAccueil();
}
if(strcmp($uri, '/') == 0){
    $frontOfficeControleur->afficherPageAccueil();
}
if(strcmp($uri, '/autoecole/') == 0){
    $frontOfficeControleur->afficherPageAccueil();
}
if(strcmp($uri, '/index.php') == 0){
    $frontOfficeControleur->afficherPageAccueil();
}
if(strcmp($uri, '/index.php/formules') == 0){
    $frontOfficeControleur->afficherFormules($pdo);
}
if(strcmp($uri, '/index.php/formuleitem') == 0){
    $frontOfficeControleur->afficherFormuleItems($pdo);
}
if(strcmp($uri, '/index.php/erreur') == 0){
    $frontOfficeControleur->afficherPageErreur();
}
if(strcmp($uri, '/index.php/login') == 0){
    $frontOfficeControleur->afficherPageLogin($pdo);
}
if(strcmp($uri, '/index.php/back') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->afficherPageBack();
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/addoption') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->afficherFormAddOption($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/showoptions') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->afficherAllOptions($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/deleteoption') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->deleteOption($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/updateoption') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->updateOption($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/addformule') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->afficherFormAddFormule($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/showformules') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->afficherAllFormules($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/deleteformule') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->deleteFormule($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/updateformule') == 0){
    if($_SESSION['login'] == "OK"){
        $backOfficeControleur->updateFormule($pdo);
    }else{
        $frontOfficeControleur->afficherPageLogin($pdo);
    }
}
if(strcmp($uri, '/index.php/deconnexion') == 0){
    $backOfficeControleur->getDeconnexion();
}
/*
else{
    $frontOfficeControleur->afficherPageErreur();
}
*/












