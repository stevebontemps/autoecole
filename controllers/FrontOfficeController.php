<?php

class FrontOfficeController
{
    public function afficherPageAccueil()
    {
        require_once('views/user/accueil.php');
    }

    public function afficherPageErreur()
    {
        require_once('views/user/erreur.php');
    }

    public function afficherPageLogin()
    {
        require_once('views/user/login.php');
    }

    public function afficherPageInfo()
    {
        require_once('views/user/information.php');
    }

    public function afficherPageContact()
    {
        require_once('views/user/contact.php');
    }
    public function afficherPageFormule()
    {
        require_once('views/user/Formule.php');
    }
}