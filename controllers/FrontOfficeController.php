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
    public function afficherFormules($pdo){

        $formulesManager = new FormulesManager($pdo);

        require_once('views/user/formules.php');

    }
    public function afficherFormuleItems($pdo){

        // DAO pour les Formules
        $formulesManager = new FormulesManager($pdo);
        // DAO pour les Options
        $optionsManager = new OptionsManager($pdo);

        $idFormule = $_GET['FormuleId'];

        $idFormule = intval($idFormule);

        if($formulesManager->exists($idFormule)){

            $formule = $formulesManager->getFormule($idFormule);

            $options = $formulesManager->selectAllOptionsFromFormule($idFormule);

            require_once('views/user/options.php');

        }
        else{
            header('Location:' . WEBSITE_URL . 'index.php/erreur');
        }

    }
    public function afficherPageLogin(PDO $pdo)
    {

        $adminsManager = new AdminsManager($pdo);

        if(isset($_POST['email']) && isset($_POST['password'])){

            $email = $_POST['email'];
            $pwd = $_POST['password'];

            $admin = $adminsManager->getAdmin($email, $pwd);

            if($admin == false){
                header('Location:' . WEBSITE_URL . 'index.php/login');
            }
            else{

                $_SESSION['nom'] = $admin->getNom();
                $_SESSION['prenom'] = $admin->getPrenom();

                $_SESSION['login'] = "OK";

                // un fois logger on redirige vers une page admin ici showpltas.php
                header('Location:' . WEBSITE_URL . 'index.php/back');
            }
        }

        require_once('views/user/login.php');

    }

}