<?php

class BackOfficeController
{
    public function afficherPageAccueil()
    {
        require_once('views/user/accueil.php');
    }
    public function afficherPageBack()
    {
        require_once('views/admin/back.php');
    }
    public function afficherFormAddOption($pdo){

        $optionsManager = new OptionsManager($pdo);

        if(isset($_POST['creer']))
        {
            // insertion de l image en base de donnees.
            // On peut valider le fichier et le stocker définitivement
            $fileTMP    = $_FILES['image']['tmp_name'];
            $fileNAME   = $_FILES['image']['name'];
            $fileTYPE   = $_FILES['image']['type'];


            //$filename = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            $destination_CP = iconv('UTF-8', 'CP1252', $fileNAME);

            // tableau des extensions
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf');


            $option = new Option(['nom' => $_POST['nom'], 'prix' => $_POST['prix'], 'image' => $destination_CP]);

            if($optionsManager->exists($option->getNom()))
            {
                $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette option existe déjà en base de données.</div>";
                unset($option);
            }
            else
            {
                // on ajoute l image dans uploads pas avant
                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['image']['name']);
                    $extension_upload = $infosfichier['extension'];

                    if(in_array($extension_upload, $extensions_autorisees))
                    {
                        //echo $file;
                        move_uploaded_file($fileTMP, 'uploads/' . basename($fileNAME));
                    }
                }

                $messageInsertOk = $optionsManager->add($option);

                //gestion du message success | error pour insertion d'option dans la bdd - avec image
                if($messageInsertOk){
                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette option a bien été ajoutée en base de données.</div>";
                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette option n'a pas pu être ajoutée en base de données.</div>";
                }
            }
        }

        require_once('views/admin/addoption.php');

    }
    public function afficherAllOptions($pdo){

        $optionsManager = new OptionsManager($pdo);

        require_once('views/admin/showoptions.php');

    }
    public function deleteOption($pdo){

        // test : http://localhost/autoecole/index.php/deleteoption?OptionId=NULL

        // on initialise une DAO pour gerer les options
        $optionsManager = new OptionsManager($pdo);

        // on recupere grace à l'URL, ET via la metohde $_GET id de l'option qu on veut supprimer
        $idOption = $_GET['OptionId'];
        $idOption = intval($idOption);

        // on regarde si id donnée dans l url renvoie bien une option qui existe
        if($optionsManager->exists($idOption)){

            // on recupere objet de type Option grace à son ID
            $obj = $optionsManager->getOption($idOption);


            // on supprime l ogjet en BD
            $res = $optionsManager->delete($obj);
        }

        //gestion du message success | error pour la suppression de l'option dans la bdd
        if($res){
            $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> l'option a bien été supprimée de la base de données.</div>";
        }
        else{
            $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> l'option n'a pas été supprimée de la base de données.</div>";
        }

        header('Location:' . WEBSITE_URL . 'index.php/showoptions');

    }
    public function updateOption($pdo){

        // http://localhost/autoecole/index.php/updateoption?OptionId=NULL

        // on recupere grace à l'URL, ET via la metohde $_GET id
        // de l'option qu on veut mettre à jour
        $idOption = $_GET['OptionId'];
        $idOption = intval($idOption);

        // on initialise une DAO pour gerer les options
        $optionsManager = new OptionsManager($pdo);

        if(isset($_POST['actualiser']))
        {
            // si la mise à jour est faite avec une nouvelle image
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

                // insertion de l image en base de donnees.
                // On peut valider le fichier et le stocker définitivement
                $fileTMP    = $_FILES['image']['tmp_name'];
                $fileNAME   = $_FILES['image']['name'];
                $fileTYPE   = $_FILES['image']['type'];


                //$filename = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                $destination_CP = iconv('UTF-8', 'CP1252', $fileNAME);

                // tableau des extensions
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf');

                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];

                if(in_array($extension_upload, $extensions_autorisees))
                {
                    //echo $file;
                    move_uploaded_file($fileTMP, 'uploads/' . basename($fileNAME));
                }

                // on recupere objet de type Option grace à son ID
                $objetOption = $optionsManager->getOption($_POST['idoption']);

                $objetOption->setNom($_POST['nom']);
                $objetOption->setPrix($_POST['prix']);
                $objetOption->setImage($destination_CP);


                $messageUpdateOk = $optionsManager->update($objetOption);

                //gestion du message success | error lors de la mise à jour de l'option dans la bdd - pour update avec image
                if($messageUpdateOk){
                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette option a bien été mise à jour en base de données.</div>";
                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette option n'a pas pu être mise à jour en base de données.</div>";
                }
            }
            else{

                // on recupere objet de type Option grace à son ID
                $objetOption = $optionsManager->getOption($idOption);

                $objetOption->setNom($_POST['nom']);
                $objetOption->setPrix($_POST['prix']);

                $messageUpdateOk = $optionsManager->update($objetOption);

                //gestion du message success | error lors de la mise à jour de l'option dans la bdd - pour update avec image
                if($messageUpdateOk){
                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette option a bien été mise à jour en base de données.</div>";
                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette option n'a pas pu être mise à jour en base de données.</div>";
                }
            }
        }
        // on regarde si id donnée dans l url renvoie bien une option qui existe
        if($optionsManager->exists($idOption)){

            // on recupere objet de type Option grace à son ID
            $objetOption = $optionsManager->getOption($idOption);

            require_once('views/admin/updateoption.php');

        }
        else{

            header('Location:' . WEBSITE_URL . 'index.php/showoptions');

        }

    }
    public function afficherFormAddFormule($pdo){

        // on initialise une DAO pour gerer les options
        $optionsManager = new OptionsManager($pdo);
        // on initialise une DAO pour gerer les formules
        $formulesManager = new FormulesManager($pdo);


        if(isset($_POST['create']))
        {
            // insertion de l image en base de donnees.
            // On peut valider le fichier et le stocker définitivement
            $fileTMP    = $_FILES['image']['tmp_name'];
            $fileNAME   = $_FILES['image']['name'];
            $fileTYPE   = $_FILES['image']['type'];


            //$filename = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            $destination_CP = iconv('UTF-8', 'CP1252', $fileNAME);

            // tableau des extensions
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf');

            // prix par defaut non NULL
            $defualt_price = 0.00;

            // $option = new Option(['nom' => $_POST['nom'], 'prix' => $_POST['prix'], 'image' => $destination_CP]);
            $formule = new Formule(['nom' => $_POST['nom'], 'prix' => $defualt_price, 'image' => $destination_CP]);

            if($formulesManager->exists($formule->getNom()))
            {
                $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette formule existe déjà en base de données.</div>";
                unset($formule);
            }
            else
            {
                // on ajoute l image dans uploads pas avant
                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['image']['name']);
                    $extension_upload = $infosfichier['extension'];

                    if(in_array($extension_upload, $extensions_autorisees))
                    {
                        //echo $file;
                        move_uploaded_file($fileTMP, 'uploads/' . basename($fileNAME));
                    }
                }

                // on insere la formule en BD
                $messageInsertOk = $formulesManager->add($formule);

                //le tableau contenant les id des options selectionnées
                $ArrayOfIdoptions = $_POST['tabIdOptions'];

                $idFormuleInserted = $formule->getId();

                if(isset($ArrayOfIdoptions) && !empty($ArrayOfIdoptions))
                {
                    foreach($ArrayOfIdoptions as $ArrayOfIdoption)
                    {
                        $formulesManager->associationOptionFormule($ArrayOfIdoption,$idFormuleInserted);
                    }

                    // on met à jour le prix de la formule
                    $formulesManager->updatePrixFormule($idFormuleInserted);
                }

                //gestion du message success | error pour insertion d'option dans la bdd - avec image
                if($messageInsertOk){

                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette formule a bien été ajoutée en base de données.</div>";

                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette formule n'a pas pu être ajoutée en base de données.</div>";
                }
            }
        }

        require_once('views/admin/addformule.php');

    }
    public function afficherAllFormules($pdo){

        $formulesManager = new FormulesManager($pdo);

        require_once('views/admin/showformules.php');

    }
    public function deleteFormule($pdo){

        // test : http://localhost/autoecole/index.php/deleteformule?FormuleId=NULL

        // on initialise une DAO pour gerer les formules
        $formulesManager = new FormulesManager($pdo);

        // on recupere grace à l'URL, ET via la metohde $_GET id de l'option qu on veut supprimer
        $idFormule = $_GET['FormuleId'];
        $idFormule = intval($idFormule);

        // on regarde si id donnée dans l url renvoie bien une option qui existe
        if($formulesManager->exists($idFormule)){

            // on recupere objet de type Option grace à son ID
            $obj = $formulesManager->getFormule($idFormule);


            // on supprime l ogjet en BD
            $res = $formulesManager->delete($obj);
        }

        //gestion du message success | error pour la suppression de l'option dans la bdd
        if($res){
            $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> la formule a bien été supprimée de la base de données.</div>";
        }
        else{
            $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> la formule n'a pas été supprimée de la base de données.</div>";
        }

        header('Location:' . WEBSITE_URL . 'index.php/showformules');

    }
    public function updateFormule($pdo){

        // http://localhost/autoecole/index.php/updateformule?FormuleId=1

        // on recupere grace à l'URL, ET via la metohde $_GET id
        // de l'option qu on veut mettre à jour
        $idFormule = $_GET['FormuleId'];
        $idFormule = intval($idFormule);

        // on initialise une DAO pour gerer les options
        $optionsManager = new OptionsManager($pdo);
        // on initialise une DAO pour gerer les formules
        $formulesManager = new FormulesManager($pdo);

        if(isset($_POST['actualiser']))
        {
            // si la mise à jour est faite avec une nouvelle image
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

                // insertion de l image en base de donnees.
                // On peut valider le fichier et le stocker définitivement
                $fileTMP    = $_FILES['image']['tmp_name'];
                $fileNAME   = $_FILES['image']['name'];
                $fileTYPE   = $_FILES['image']['type'];


                //$filename = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                $destination_CP = iconv('UTF-8', 'CP1252', $fileNAME);

                // tableau des extensions
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf');

                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];

                if(in_array($extension_upload, $extensions_autorisees))
                {
                    //echo $file;
                    move_uploaded_file($fileTMP, 'uploads/' . basename($fileNAME));
                }

                // on recupere objet de type Formule grace à son ID
                $objetFormule = $formulesManager->getFormule($_POST['idformule']);

                $idFormuleToBeUpdated = $objetFormule->getId();

                $formulesManager->suppressionCorrespondanceOptionsFormule($idFormuleToBeUpdated);

                $objetFormule->setNom($_POST['nom']);
                $objetFormule->setImage($destination_CP);

                $messageUpdateOk = $formulesManager->update($objetFormule);

                //le tableau contenant les id des options selectionnées
                $ArrayOfIdoptions = $_POST['tabIdOptions'];

                if(isset($ArrayOfIdoptions) && !empty($ArrayOfIdoptions))
                {
                    foreach($ArrayOfIdoptions as $ArrayOfIdoption)
                    {
                        $formulesManager->associationOptionFormule($ArrayOfIdoption,$idFormuleToBeUpdated);
                    }

                    // on met à jour le prix de la formule
                    $formulesManager->updatePrixFormule($idFormuleToBeUpdated);
                }



                //gestion du message success | error lors de la mise à jour de l'option dans la bdd - pour update avec image
                if($messageUpdateOk){
                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette formule a bien été mise à jour en base de données.</div>";
                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette formule n'a pas pu être mise à jour en base de données.</div>";
                }
            }
            else{
                // on recupere objet de type Formule grace à son ID
                $objetFormule = $formulesManager->getFormule($_POST['idformule']);

                $idFormuleToBeUpdated = $objetFormule->getId();

                $formulesManager->suppressionCorrespondanceOptionsFormule($idFormuleToBeUpdated);

                $objetFormule->setNom($_POST['nom']);

                $messageUpdateOk = $formulesManager->update($objetFormule);

                //le tableau contenant les id des options selectionnées
                $ArrayOfIdoptions = $_POST['tabIdOptions'];

                if(isset($ArrayOfIdoptions) && !empty($ArrayOfIdoptions))
                {
                    foreach($ArrayOfIdoptions as $ArrayOfIdoption)
                    {
                        $formulesManager->associationOptionFormule($ArrayOfIdoption,$idFormuleToBeUpdated);
                    }

                    // on met à jour le prix de la formule
                    $formulesManager->updatePrixFormule($idFormuleToBeUpdated);
                }

                //gestion du message success | error lors de la mise à jour de la formule dans la bdd - pour update avec image
                if($messageUpdateOk){
                    $_SESSION['message'] = "<div class='alert alert-success fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Bravo !</strong> cette formule a bien été mise à jour en base de données.</div>";
                }
                else{
                    $_SESSION['message'] = "<div class='alert alert-danger fade in col-lg-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Erreur !</strong> cette formule n'a pas pu être mise à jour en base de données.</div>";
                }
            }
        }
        // on regarde si id donnée dans l url renvoie bien une formule qui existe
        if($formulesManager->exists($idFormule)){

            // on recupere objet de type Option grace à son ID
            $objetFormule = $formulesManager->getFormule($idFormule);

            require_once('views/admin/updateformule.php');

        }
        else{
            header('Location:' . WEBSITE_URL . 'index.php/showformules');
        }
    }
    public function getDeconnexion(){

        session_destroy();

        header('Location:' . WEBSITE_URL . 'index.php/login');

        exit();
    }

}
