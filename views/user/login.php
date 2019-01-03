<?php

// $titre = "Audemobile User Application";
ob_start();

?>

    <section id="contact">
        <div class="container">
            <div class="row text-center" >
                <div class="col-md-12">
                    <h1>Identifiez Vous</h1>
                </div>
            </div>
            <div class="row text-center pad-top" >
                <div class="col-md-4 col-md-offset-4">
                    <div class="row ">
                        <form role="form" method="post" action="">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Enter your Email" />
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input type="password" name="password" id="password" class="form-control" required="required" placeholder="Enter your Password" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" value="Login" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

// render
$contenuFrontOffice = ob_get_clean();
require_once('views/frontofficelayout.php');

?>