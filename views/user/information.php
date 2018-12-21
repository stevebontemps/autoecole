<?php
/**
 * Created by PhpStorm.
 * User: bontemps
 * Date: 18/12/18
 * Time: 10:56
 */
?>
<!-- Page Content -->
    <section>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h1>Information</h1>
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