<?php

// $titre = "Audemobile User Application";
ob_start();

?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Formulaire de mise à d'une Formule
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        //on affiche le message de suuccess | error d insertion
                        if(isset($_SESSION['message'] )){echo $_SESSION['message']; unset($_SESSION['message']);}
                        ?>
                    </div>
                </div>
                <!-- /.row    -->

                <div class="row">
                    <div class="col-lg-6">
                        <!-- onsubmit="return validate();" -->
                        <!-- <form role="form" method="post" enctype="multipart/form-data" action="" name="myForm"> -->
                        <form role="form" action="" method="post" name="myFormUpdateFormule" onsubmit="return validate();" enctype="multipart/form-data">

                            <div class="form-group">
                                <input class="form-control" type="hidden" name="idformule" id="idformule"
                                       value="<?= $objetFormule->getId(); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>le nom</label>
                                <input class="form-control" type="text" name="nom" id="nom"
                                       value="<?= $objetFormule->getNom(); ?>"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">l'image</label>
                                <input type="file" class="filestyle" name="image" id="fileToUpload" data-buttonText="Choisir">
                            </div>

                            <div class="form-group">
                                <label class="control-label">les Options</label></br>
                                <select class="form-control" id="tabIdOptions" name="tabIdOptions[]" multiple="multiple">
                                    <?php
                                    // on recupere toutes les Options
                                    $objOptions = $optionsManager->selectAllOptions();

                                    if(empty($objOptions))
                                    {
                                        echo 'Pas d\' option Erreur !';
                                    }
                                    else{
                                        foreach($objOptions as $objOption) {
                                            echo '<option value=' . $objOption->getId() . '>' . $objOption->getNom() . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-default" name="actualiser">Envoyer</button>

                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

// render
$contenuBackOffice = ob_get_clean();
require_once('views/backofficelayout.php');

?>