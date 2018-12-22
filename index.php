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
// session_destroy();


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
//$db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

//$myDB = $db->getConnection();


// On enregistre notre autoload pour les controlleurs.
//require('controllers/ControllersAutoloader.php');
// on appele une methode : register de la Classe Autoloader
// ControllersAutoloader::register();

require_once('controllers/FrontOfficeController.php');
require_once('controllers/BackOfficeController.php');

$frontOfficeControleur = new FrontOfficeController();
$backOfficeControleur = new BackOfficeController();
/*
debug("Mes controlleurs : ");
debug($frontOfficeControleur);
debug($backOfficeControleur);
*/



//Récupération de l' URL
$uri = $_SERVER['REQUEST_URI'];
$uri = substr($uri, strpos($uri, '/index.php'));
$uriTab = explode('?', $uri);
$uri = $uriTab[0];

/* Debug */
//debug($myDB);
//exit();
// debug($uri);
$id = '1';
$nom = '20h de conduite';
$prix = 690.99;
$image = 'conduite.jpg';

// INSERT INTO OPTIONS (NOM,PRIX,IMAGE) VALUES ('20h de conduite',690.99,'conduite.jpg');

$option = new Option(['id' => $id, 'nom'=> $nom, 'prix'=> $prix, 'image'=> $image]);

$optionsManager = new OptionsManager($db);

// test la methode add
// $var = $optionsManager->add($option);

// test de la methode count
debug($optionsManager->count());
// test de la methode de la récuperation de l'objet option
debug($optionsManager->getOption(1));
// test de la methode delete
debug($optionsManager->delete($option));
// test de la methode count
debug($optionsManager->count());


// echo $var->toString();
// debug($option->toString());


exit();


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
if(strcmp($uri, '/index.php/erreur') == 0){
    $frontOfficeControleur->afficherPageErreur();
}
if(strcmp($uri, '/index.php/login') == 0){
    $frontOfficeControleur->afficherPageLogin();
}
if(strcmp($uri,'/index.php/information') == 0){
    $frontOfficeControleur->afficherPageInfo();
}
if(strcmp($uri,'/index.php/contact') == 0){
    $frontOfficeControleur->afficherPageContact();
}
if(strcmp($uri,'/index.php/formule') == 0){
    $frontOfficeControleur->afficherPageFormule();
}
/*
else{
    $frontOfficeControleur->afficherPageErreur();
}
*/












