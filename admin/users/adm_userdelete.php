<?php
    require('../../include/connect.php');
    require('../../include/header.php');
    require('../include/log.php');

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $user_id = (int) $_GET['id'];

    // On sélectionne l'utilisateur pour être sur qu'il existe et faire un rappel
    $select = $bdd->prepare('SELECT * FROM user WHERE id = :idUser');
    $select->bindValue(':idUser', $user_id, PDO::PARAM_INT);

    if($select->execute()){
        $my_user = $select->fetch(PDO::FETCH_ASSOC);
    }
    if(!empty($_POST)){
        // Si la valeur du champ caché ayant pour name="action" est égale a delete, alors je supprime
        if(isset($_POST['action']) && $_POST['action'] === 'delete'){
            $delete = $bdd->prepare('DELETE FROM user WHERE id = :idUser');
            $delete->bindValue(':idUser', $user_id, PDO::PARAM_INT);

            if($delete->execute()){
                $success = '<div class="alert alert-success">L\'utilisateur a été supprimé !</div>';
                header("refresh:5;url=../adm_users.php");
            }
            else {
                var_dump($delete->errorInfo()); 
                die;
            }
        }
    }
}

?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="pmdmp">
        <title>Welcomed</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../css/bootstrap337.css">
    <!-- Custom CSS -->
        <link rel="stylesheet" href="../../css/sb-admin.css">
        <link rel="stylesheet" href="../../css/plugins/morris.css') ?>">
        <link rel="stylesheet" href="../../css/styleadmin.css">
        <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">

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
                            <a href="../home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li class="active">
                            <a href="../adm_users.php"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                        </li>
                        <li>
                            <a href="../adm_ads.php"><i class="fa fa-fw fa-cutlery"></i> Annonces</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-envelope fa-arrows-v"></i> Contacts <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="../adm_unreadcontacts.php"><i class="fa fa-fw fa-envelope-o"></i> Nouveaux messages</a>
                                </li>
                                <li>
                                    <a href="../adm_readcontacts.php"><i class="fa fa-fw fa-envelope-open-o"></i> Déja lus</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="../adm_partners.php"><i class="fa fa-handshake-o"></i> Partenariats</a>
                        </li>
                        <li>
                            <a href="../adm_edit.php"><i class="fa fa-paint-brush"></i> Personnalisation</a>
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
                                    <i class="fa fa-dashboard"> Supprimer l'utilisateur</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
            
                    <?php if(!isset($my_user) || empty($my_user)): ?>
                        <p style="color:red">Désolé, aucun utilisateur correspondant</p>
        
                    <?php elseif(isset($success)): ?>
                        <?php echo $success; ?>

                    <?php else: ?>
                    <div class="col-xs-12 deleteuser">
                        <h2>Voulez-vous supprimer : <?=$my_user['firstname'].' '.$my_user['lastname']. ' - '.$my_user['email'];?></h2>

                    <form method="post">
                        
                        <input type="hidden" name="action" value="delete">

                        <!-- history.back() permet de revenir à la page précédente -->
                        <button type="button" class="btn btn-default" onclick="javascript:history.back();">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="Supprimer cet utilisateur">
                    </form>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../../js/jquery-1.11.1.js"></script>
        <!-- Bootstrap JS -->
        <script src="../../js/bootstrap.min.js"></script>
        
        <!-- Script JS -->
        <script src="../../js/script.js"></script>
        <script src="../../js/button.js"></script>
        
        <!-- Morris Charts JS -->
        <script src="../../js/plugins/morris/raphael.min.js"></script>
        <script src="../../js/plugins/morris/morris.min.js"></script>
        <script src="../../js/plugins/morris/morris-data.js"></script>
    
    </body>
</html>