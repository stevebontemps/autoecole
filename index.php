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
$id = 2;
$nom = '20h de conduite';
$prix = 690.99;
$image = 'conduite.jpg';

// INSERT INTO OPTIONS (NOM,PRIX,IMAGE) VALUES ('20h de conduite',690.99,'conduite.jpg');

$option = new Option(['id' => $id, 'nom'=> $nom, 'prix'=> $prix, 'image'=> $image]);


$optionsManager = new OptionsManager($db);

// test la methode add
// $var = $optionsManager->add($option);


// test de la methode count
//debug($optionsManager->count());

// test de la methode de la récuperation de l'objet option
// debug($optionsManager->getOption(2));

// test de la methode delete
// debug($optionsManager->delete($option));

// test de la methode count
// debug($optionsManager->count());

// test de la methode exists sur un objet existant dans la base de donnees
// debug($optionsManager->exists($option->getId()));

// test de la methode exists sur un objet non existant dans la base de donnees
// debug($optionsManager->exists(3));



// test la methode updadeSansImage
// $option->setNom('30h de conduite');
// $option->setPrix(1189.99);
// debug($optionsManager->updateSansImage($option));
// debug($option->toString());

// test de la methode updateAvecImage
// $option->setImage('voiture.png');
// debug($optionsManager->update($option));
// debug($option->toString());

// echo $var->toString();
// debug($option->toString());

// test de la methode selectAllOptions
// debug($optionsManager->selectAllOptions());
$idF = 2;
$nomF = 'conduite accompagnée';
$prixF = 1690.99;
$imageF = 'conduite_accompagnée.jpg';

$formule = new Formule(['id' => $idF, 'nom' => $nomF, 'prix' => $prixF, 'image' => $imageF ]);


$formulesManager = new FormulesManager($db);
//debug($formulesManager);

// test la methode add  INSERT INTO Formules (NOM,PRIX,IMAGE) VALUES ('conduite accompagnée',1690.99,'conduite_accompagnée.jpg');
$var = $formulesManager->add($formule);
debug($formule);
debug($var);

// test la methode add
$var = $formulesManager->add($formule);
debug($var);

// test la methode count
debug($formulesManager->count());

// test la methode countFormule


// test la methode delete
debug($formulesManager->delete($var));

// test la methode exists


// test getFormule($id)
debug($formulesManager->getFormule(4));


// countOptionAssociatedToFormuleId($formuleId)
//debug($formulesManager->countOptionAssociatedToFormuleId($formuleId));
//exit;

// test la methode update


// test la methode updateSansImage


// test la methode associationOptionFormule


// test la methode updatePrixFormule


// test la methode selectAllFormules


// test la methode faireCorrespondreOptionsFormule


// test la methode suppressionCorrespondanceOptionsFormule




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












