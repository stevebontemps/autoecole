<?php

// $titre = "Audemobile Admin Application";
ob_start();

?>
    <div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">
                        La Liste des <?= $formulesManager->count(); ?> Formules
                    </h1>
                </div>
                <div class="col-lg-12">
                    <?php
                    //on affiche le message de success | error de mise à jour ou suppression
                    if(isset($_SESSION['message']))
                    {
                        // on affiche le message
                        echo $_SESSION['message'];
                        // on vide le message pour qu'il n'apparaisse qu'une fois
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-9">
                </div>
                <div class="col-lg-3">
                    <a href="<?=WEBSITE_URL?>index.php/addformule"><button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <h2>Tableau des formules</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Modifier</th>
                                <th>Suppression</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //on recupere touts les plats de la bdd :
                            $formules = $formulesManager->selectAllFormules();
                            foreach($formules as $formule)
                            {
                                // num me sert pour la fenetre modale
                                $num = $formule->getId();
                                // utf8_decode() ou utf8_encode()
                                $img = utf8_encode($formule->getImage());
                                ?>
                                <tr>
                                    <td><a href="<?=WEBSITE_URL?>index.php/updateformule?FormuleId=<?=$num;?>"><img class="media-object" src="<?=WEBSITE_URL?>uploads/<?=$img?>" alt="" style='width:80px;height:80px;'></a></td>
                                    <td><?=$formule->getNom();?></td>
                                    <td><?=$formule->getPrix();?></td>
                                    <td><a href="<?=WEBSITE_URL?>index.php/updateformule?FormuleId=<?=$num;?>"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></a></td>
                                    <td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal<?=$num;?>"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                                </tr>

                                <div class="modal fade" id="myModal<?=$num;?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Attention</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer l'option numero <?=$num;?> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?=WEBSITE_URL?>index.php/deleteformule?FormuleId=<?=$num;?>"><button type="button" class="btn btn-default">Supprimer</button></a>

                                            </div>
                                        </div>
                                        <!--modal-dialog-->
                                    </div>
                                    <!--modal modal-->
                                </div>
                                <!-- fermeture de la div foreach-->
                                <?php
                                //fin du foreach sur les plats
                                ;}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php

// render
$contenuBackOffice = ob_get_clean();

require_once('views/backofficelayout.php');

?>