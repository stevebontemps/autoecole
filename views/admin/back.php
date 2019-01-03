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
                            Bienvenue dans le back office ACE - Driving Schoole
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        //on affiche le message de suuccess | error d insertion
                        if(isset($message)){echo $message;}
                        ?>
                    </div>
                </div>
                <!-- /.row    -->

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Bonjour <?=$_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?> !</h2>
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