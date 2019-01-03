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
                            Formulaire de mise à jour d'une Option
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        //on affiche le message de suuccess | error de mise à jour
                        if(isset($_SESSION['message'] )){echo $_SESSION['message']; unset($_SESSION['message']);}
                        ?>
                    </div>
                </div>
                <!-- /.row    -->

                <div class="row">
                    <div class="col-lg-6">
                        <!-- onsubmit="return validate();" -->
                        <!-- <form role="form" method="post" enctype="multipart/form-data" action="" name="myForm"> -->
                        <form role="form" action="" method="post" name="myFormAddOption" onsubmit="return validate();" enctype="multipart/form-data">


                            <div class="form-group">
                                <input class="form-control" type="hidden" name="idoption" id="idoption"
                                       value="<?php echo $objetOption->getId(); ?>" />
                            </div>

                            <div class="form-group">
                                <label>le nom</label>
                                <input class="form-control" type="text" name="nom" id="nom"
                                       value="<?php echo $objetOption->getNom(); ?>" />
                            </div>

                            <div class="form-group">
                                <label>le prix</label>
                                <input class="form-control" type="text" name="prix" id="prix"
                                       value="<?php echo $objetOption->getPrix(); ?>" />
                            </div>

                            <div class="form-group">
                                <label class="control-label">l'image</label>
                                <input type="file" class="filestyle" name="image" id="fileToUpload" data-buttonText="Choisir">
                            </div>
                            <button type="submit" class="btn btn-default" name="actualiser">Envoyer</button>
                            <!-- <input type="submit" value="Mise à jour plat" name="updatePlatId" /> -->
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