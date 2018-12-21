<?php

// $titre = "Audemobile User Application";
ob_start();

?>

    <!-- Page Content -->
    <h1>ERREUR 404 - Page Not Found !!!</h1>

<?php

// render
$contenuFrontOffice = ob_get_clean();
require_once('views/frontofficelayout.php');

?>