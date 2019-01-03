<?php

// $titre = "Audemobile User Application";
ob_start();

?>

    <section>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h1>Les Formules de l'auto-école</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    //on recupere touts les formules de la bdd :
                    $formules = $formulesManager->selectAllFormules();

                    foreach($formules as $formule)
                    {
                        // num me sert pour la fenetre modale
                        $num = $formule->getId();
                        $img = utf8_encode($formule->getImage());

                        ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="<?=WEBSITE_URL?>index.php/formuleitem?FormuleId=<?=$num;?>"><img src="<?=WEBSITE_URL?>uploads/<?=$img?>" alt=""></a>
                                <div class="caption">
                                    <h4 class="pull-right"><?=$formule->getPrix();?>€</h4>
                                    <h4><a href="<?=WEBSITE_URL?>index.php/formuleitem?FormuleId=<?=$num;?>"><?=$formule->getNom();?></a></h4>
                                    <p>Description de la formule : orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <div class="checkout">
                                    <p><a class="btn btn-info mybouton" target="_blank" href="#">Ajouter</a></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!-- /.container -->

<?php

// render
$contenuFrontOffice = ob_get_clean();
require_once('views/frontofficelayout.php');

?>