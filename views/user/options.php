<?php

// $titre = "Audemobile User Application";
ob_start();

?>
<!-- Page Content -->
<section>

    <div class="container">

        <div class="row text-center">
            <div class="col-md-12">
                <h1>les Options constituant la <?=$formule->getNom();?></h1>
            </div>
        </div>

        <!--Row For Image and Short Description-->
        <div class="row">

            <div class="col-md-12">

                <div class="col-md-9">

                    <?php
                    foreach($options as $option)
                    {
                        $num = $formule->getId();
                        $img = utf8_encode($option->getImage());
                        ?>

                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=WEBSITE_URL?>uploads/<?=$img?>" alt=""></a>
                                <div class="caption">
                                    <h4 class="text-center"><a href="#"><?=$option->getNom();?></a></h4>
                                    <p>Description : orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                </div><!--Row col-9 des plats-->
                <?php $imgformule = utf8_encode($formule->getImage()); ?>

                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="#"><img src="<?=WEBSITE_URL?>uploads/<?=$imgformule?>" alt=""></a>
                        <div class="caption">
                            <h4 class="pull-right"><?=$formule->getPrix();?>€</h4>
                            <h4><a href="#"><?=$formule->getNom();?></a></h4>
                            <p>Description de la formule : orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="checkout">
                            <p><a class="btn btn-info mybouton" target="_blank" href="#">Ajouter</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div><!--Row For Image and Short Description-->
    </div><!--Container-->

</section>
<!-- /.container -->
<!-- /.container -->
<?php

// render
$contenuFrontOffice = ob_get_clean();
require_once('views/frontofficelayout.php');

?>
