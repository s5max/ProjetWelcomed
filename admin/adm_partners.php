<?php
    require('../include/connect.php');
    require('include/log.php');

    $select = $bdd->prepare('SELECT * FROM partnership ORDER BY partner_id ASC');

    if($select->execute()){
        $partners = $select->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        echo 'Une erreur s\'est produite!';
        die; //alias de exit(); => die('Hello World');
    }

?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="pmdmp">
        <title>Welcomed</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap337.css">
    <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/sb-admin.css">
        <link rel="stylesheet" href="../css/plugins/morris.css') ?>">
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    </head>
    <body>
        <div id="wrapper">

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
                    <a class="navbar-brand" href="../home.php">Welcomed</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> <?php echo $user['firstname'].' '.$user['lastname'];?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profil</a>
                            </li> -->
                            <li>
                                <a href="../adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="../logout.php?logout=yes"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="./"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li>
                            <a href="adm_users.php"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                        </li>
                        <li>
                            <a href="adm_ads.php"><i class="fa fa-fw fa-cutlery"></i> Annonces</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-envelope fa-arrows-v"></i> Contacts <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope-o"></i> Nouveaux messages</a>
                                </li>
                                <li>
                                    <a href="adm_readcontacts.php"><i class="fa fa-fw fa-envelope-open-o"></i> Déja lus</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="adm_partners.php"><i class="fa fa-handshake-o"></i> Partenariats</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#edit"><i class="fa fa-paint-brush"></i> Personnalisation<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="edit" class="collapse">
                                <li>
                                    <a href="adm_edittext.php"><i class="fa fa-file-text"></i> Texte</a>
                                </li>
                                <li>
                                    <a href="adm_editpicture.php"><i class="fa fa-picture-o"></i> Images</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
            
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Panneau D'Administration
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-dashboard"> Partenariats</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <table class="table table-inverse table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Partenaires</th>
                                <th>Détail</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- foreach permettant d'avoir une ligne <tr> par ligne SQL -->
                            <?php foreach($partners as $partner): ?>

                                <tr>
                                    <td><?=$partner['partner_id']; ?></td>
                                    <td><?=$partner['name']; ?></td>
                                    <td><?=$partner['partner']; ?></td>
                                    <td>
                                        <a href="partners/adm_partner.php?id=<?=$partner['partner_id']; ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="partners/adm_partnerdelete.php?id=<?=$partner['partner_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                    
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery-1.11.1.js"></script>
        <!-- Bootstrap JS -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Script JS -->
        <script src="../js/script.js"></script>
        <script src="../js/button.js"></script>
        
        <!-- Morris Charts JS -->
        <script src="../js/plugins/morris/raphael.min.js"></script>
        <script src="../js/plugins/morris/morris.min.js"></script>
        <script src="../js/plugins/morris/morris-data.js"></script>

    
    </body>
</html>