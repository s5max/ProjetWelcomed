<?php
    require('../../include/connect.php');
    require('../include/log.php');


    $imgU = []; // Contiendra les données épurées
    $errors = [];
    $success = false;
    $maxSize = (1024 * 1000) * 4; // 1Ko => 1024 octets
    $upload_dir = '../../img/';
    $mimeTypeAvailable = ['image/png', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif'];
    $finfo = '';
    $newName = "";


    if(isset($_GET['id']) && !empty($_GET['id'])){

        $imgId = (int) $_GET['id'];

        $updateImg = $bdd->prepare('SELECT * FROM pictures WHERE img_id = :imgId');
        $updateImg->bindValue(':imgId', $imgId, PDO::PARAM_INT);

        if($updateImg->execute()){
            $image = $updateImg->fetch(PDO::FETCH_ASSOC);

        }
        else {
            // Erreur de développement
            var_dump($image->errorInfo());
            die; // alias de exit(); => die('Hello world');
        }
    }

        // Ici on traite l'upload d'image
        if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0){ // Permet de vérifier qu'un fichier est envoyé

        $finfo = new finfo();
        $mimeType = $finfo->file($_FILES['picture']['tmp_name'], FILEINFO_MIME_TYPE);

        $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

        // On vérifie que le type de fichier est un mime type valide
        if(in_array($mimeType, $mimeTypeAvailable)){

            // Vérification de la taille 
            if($_FILES['picture']['size'] <= $maxSize){

                if(!is_dir($upload_dir)){
                    mkdir($upload_dir, 0755); // Créer le dossier
                }

                // Renomme le fichier
                $newName = uniqid('img_').'.'.$extension;

                if(!move_uploaded_file($_FILES['picture']['tmp_name'], $upload_dir.$newName)){
                    $errors[] = 'Error during picture\'s upload  !';
                } else {

                    if(count($errors) === 0){

                        $update = $bdd->prepare('UPDATE pictures SET img_url = :img_url WHERE img_id = :id');
                        $update->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                        $update->bindValue(':img_url', $newName);


                        if($update->execute()){
                            $success = true;
                            header("refresh:3");
                        } else {
                            var_dump($update->errorInfo());
                        }
                    } else {
                        $textErrors = implode('<br>', $errors);
                    }
                }
            // endif $_GET['id']





            }
            else {
                    $errors[] = 'L\'image excède 2 Mo !';
                }
            }
            else {
                $errors[] = 'L\'image n\'est pas valide !';
            }
        }
        else {
            $newName = $image['img_url'];
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
                            <a href="../"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
                        </li>
                        <li>
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
                        <li class="active">
                            <a href="javascript:;" data-toggle="collapse" data-target="#edit"><i class="fa fa-paint-brush"></i> Personnalisation<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="edit" class="collapse">
                                <li>
                                    <a href="../adm_edittext.php"><i class="fa fa-file-text"></i> Texte</a>
                                </li>
                                <li>
                                    <a href="../adm_editpicture.php"><i class="fa fa-picture-o"></i> Images</a>
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
                                    <i class="fa fa-dashboard"> Mettre à jour l'image</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="col-xs-12">
                        <?php if($success == true): // La variable $success est envoyé via le controller?>
                        <?php echo '<div class="alert alert-success">Le compte a été mis à jour.</div>'; ?>
                        <?php endif; ?>

                        <?php if(!empty($errors)): // La variable $errors est envoyé via le controller?>
                        <?php echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>'; ?>
                        <?php endif; ?>
                    </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="col-md-12 panel panel-default r-p">

                                <div class="panel-heading">
                                    <h1 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Détail de l'image</h1>
                                </div>
                                <div>
                                    <form class="form-horizontal col-sm-12 uppicture" method="post" enctype="multipart/form-data">

                                        <!-- Titre -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Titre :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="title" value="<?=$image['title']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Taille -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Taille Recommandée :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="img_size" value="<?=$image['img_size']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="description" value="<?=$image['description']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="col-md-12 panel panel-default r-p">

                                <div class="panel-heading">
                                    <h1 class="panel-title"><i class="fa fa-refresh"></i> Mettre à jour</h1>
                                </div>

                                    <div class="admpicupdate">
                                        <?php echo '<img src="../../img/'.$image['img_url'].'" class="img-responsive">'; ?>
                                    </div>

                                    <form class="form-horizontal col-sm-12 uppicture" method="post" enctype="multipart/form-data">

                                        <!-- Image -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Image :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                                    <input type="file" class="form-control" name="picture" value="<?=$image['img_url']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bouton d'envoi -->
                                        <div class="col-xs-12" style="text-align:center">
                                            <button type="submit" class="btn btn-primary" id="button">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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