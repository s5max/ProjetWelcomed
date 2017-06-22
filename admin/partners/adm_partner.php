<?php
    require('../../include/connect.php');
    require('../include/log.php');


    $partnerU = []; // Contiendra les données épurées
    $errors = [];
    $success = false;
    $maxSize = (1024 * 1000) * 4; // 1Ko => 1024 octets
    $upload_dir = '../../img/';
    $mimeTypeAvailable = ['image/png', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif'];
    $finfo = '';
    $newName = "";


    if(isset($_GET['id']) && !empty($_GET['id'])){

        $partnerId = (int) $_GET['id'];

        $updateText = $bdd->prepare('SELECT * FROM partnership WHERE partner_id = :partnerId');
        $updateText->bindValue(':partnerId', $partnerId, PDO::PARAM_INT);

        if($updateText->execute()){
            $partner = $updateText->fetch(PDO::FETCH_ASSOC);

        }
        else {
            // Erreur de développement
            var_dump($image->errorInfo());
            die; // alias de exit(); => die('Hello world');
        }
    }

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $idPartner = (int) $_GET['id'];

        // Soumission du formulaire
        if(!empty($_POST)){

            // équivalent au foreach de nettoyage
            $post = array_map('trim', array_map('strip_tags', $_POST)); 

            if(empty($post['partner'])) {
                $errors[] = "Veuillez renseigner le nom du partenaire !";
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
                    }
                } else {
                        $errors[] = 'L\'image excède 2 Mo !';
                    }
                } else {
                    $errors[] = 'L\'image n\'est pas valide !';
                }
            }

            if(count($errors) === 0)
            {

                $update = $bdd->prepare('UPDATE partnership SET partner = :partner, description = :description, partner_link = :partner_link, partner_picture = :partner_picture WHERE partner_id = :partner_id');

                $update->bindValue(':partner_id', $idPartner, PDO::PARAM_INT);
                $update->bindValue(':partner', $post['partner']);
                $update->bindValue(':description', $post['description']);
                $update->bindValue(':partner_link', $post['partner_link']);
                $update->bindValue(':partner_picture', $newName);

                if($update->execute())
                {
                    $success = 'Félicitations la publicité a été créé !';
                    header("refresh:3");
                }
                else
                {
                    var_dump($update->errorInfo());
                }
            }
            else
            {
                $textErrors = implode('<br>', $errors);
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
                        <li class="active">
                            <a href="../adm_partners.php"><i class="fa fa-handshake-o"></i> Partenariats</a>
                        </li>
                        <li>
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
                                    <i class="fa fa-dashboard"> Edition de publicité</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    

                            <div class="col-md-6 col-xs-12">
                                <div class="col-md-12 panel panel-default r-p">

                                <div class="panel-heading">
                                    <h1 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> <?php echo $partner['name']; ?></h1>
                                </div>
                                <div>
                                    <form class="form-horizontal col-sm-12 uppicture" method="post" enctype="multipart/form-data">

                                        <!-- Titre -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Partenaire :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" value="<?=$partner['partner']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lien -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Lien :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" value="<?=$partner['partner_link']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                    <textarea rows="5" type="text" class="form-control" disabled><?=$partner['description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Image :</label>
                                                <div class="admpicupdate">
                                                    <?php if(!empty($partner['partner_picture'])):?>
                                                    <?php echo '<img src="../../img/'.$partner['partner_picture'].'" class="img-responsive">'; ?>
                                                    <?php endif; ?>
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

                                    <form class="form-horizontal col-sm-12 uppicture" method="post" enctype="multipart/form-data">

                                    <div class="col-xs-12">
                                        <?php if($success == true): // La variable $success est envoyé via le controller?>
                                        <?php echo '<div class="alert alert-success">Le texte a été mis à jour.</div>'; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($errors)): // La variable $errors est envoyé via le controller?>
                                        <?php echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>'; ?>
                                        <?php endif; ?>
                                    </div>

                                        <!-- Titre -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Partenaire : <span class="requis">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="partner" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lien -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Lien :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="partner_link">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                    <textarea rows="5" type="text" class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Publier une image :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                                    <input type="file" class="form-control" name="picture">
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