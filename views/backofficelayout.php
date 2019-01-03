<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Driving School Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=WEBSITE_URL?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=WEBSITE_URL?>assets/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=WEBSITE_URL?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- mon script de validation du formulaire -->

</head>

<body>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#options"><i class="fa fa-fw fa-truck"></i>Gestion des Options <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="options" class="collapse">
                <li>
                    <a href="<?=WEBSITE_URL?>index.php/addoption">Ajouter une Option</a>
                </li>
                <li>
                    <a href="<?=WEBSITE_URL?>index.php/showoptions">Lister les Options</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#formules"><i class="fa fa-fw fa-bars"></i>Gestion des Formules <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="formules" class="collapse">
                <li>
                    <a href="<?=WEBSITE_URL?>index.php/addformule">Ajouter une Formule</a>
                </li>
                <li>
                    <a href="<?=WEBSITE_URL?>index.php/showformules">Lister les Formules</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="fa fa-fw fa-users"></i>Gestion Admins <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="admin" class="collapse">
                <li>
                    <a href="#">Ajouter un Admin</a>
                </li>
                <li>
                    <a href="#">Lister les Admins</a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Back-Office Driving School</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?=$_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?=$_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php //echo $first_name . ' ' . $last_name;?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?=WEBSITE_URL?>index.php/deconnexion"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-collapse -->
</nav>

<?php echo $contenuBackOffice; ?>

</body>
<!-- jQuery -->
<script src="<?=WEBSITE_URL?>assets/plugins/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="<?=WEBSITE_URL?>assets/plugins/bootstrap.js"></script>

</html>
