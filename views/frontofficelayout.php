<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="autoecole" />
    <meta name="author" content="" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>ACE</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="<?=WEBSITE_URL?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE CSS -->
    <link href="<?=WEBSITE_URL?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="<?=WEBSITE_URL?>assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>



<body data-spy="scroll" data-target=".navbar-fixed-top">

<!--NAVBAR SECTION-->
<div class="navbar navbar-inverse navbar-fixed-top scrollclass" >

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=WEBSITE_URL?>">Auvolant Auto-école</a>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=WEBSITE_URL?>">Accueil</a></li>
                <li><a href="<?=WEBSITE_URL . 'index.php/formules'?>">Formules</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Info</a></li>
                <li><a href="<?=WEBSITE_URL . 'index.php/login'?>">Login</a></li>
            </ul>
        </div>

    </div>
</div>
<!--END NAVBAR SECTION-->

<?php echo $contenuFrontOffice; ?>

<!--FOOTER SECTION-->
<div id="footer">
    2018 ACE | All Right Reserved  | Design by <a href="http://auvolant.fr/" target="_blank" >Auvolant</a>
</div>
<!--FOOTER SECTION-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY  -->
<script src="<?=WEBSITE_URL?>assets/plugins/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="<?=WEBSITE_URL?>assets/plugins/bootstrap.js"></script>
<!-- EASING SCROLL SCRIPTS PLUGIN  -->
<script src="<?=WEBSITE_URL?>assets/plugins/jquery.easing.min.js"></script>
<!-- CUSTOM SCRIPTS   -->
<script src="<?=WEBSITE_URL?>assets/js/custom.js"></script>
</body>
</html>