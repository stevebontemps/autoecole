<?php

// $titre = "Audemobile User Application";
ob_start();

?>

    <!-- Page Content -->
    <section>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h1>Acceuil</h1>
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