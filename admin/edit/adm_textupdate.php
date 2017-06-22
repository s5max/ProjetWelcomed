<?php
    require('../../include/connect.php');
    require('../include/log.php');


    $textU = []; // Contiendra les données épurées
    $errors = [];
    $success = false;


    if(isset($_GET['id']) && !empty($_GET['id'])){

        $textId = (int) $_GET['id'];

        $updateText = $bdd->prepare('SELECT * FROM home_text WHERE text_id = :textId');
        $updateText->bindValue(':textId', $textId, PDO::PARAM_INT);

        if($updateText->execute()){
            $text = $updateText->fetch(PDO::FETCH_ASSOC);

        }
        else {
            // Erreur de développement
            var_dump($image->errorInfo());
            die; // alias de exit(); => die('Hello world');
        }
    }

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $idText = (int) $_GET['id'];

        // Soumission du formulaire
        if(!empty($_POST)){

            // équivalent au foreach de nettoyage
            $post = array_map('trim', array_map('strip_tags', $_POST)); 

            if(strlen($post['text_content']) < 0) {
                $errors[] = "Le champ doit contenir au minimum 2 caractères";
            }

            if(count($errors) === 0)
            {

                $update = $bdd->prepare('UPDATE home_text SET text_content = :text_content WHERE text_id = :text_id');

                $update->bindValue(':text_id', $idText, PDO::PARAM_INT);
                $update->bindValue(':text_content', $post['text_content']);

                if($update->execute())
                {
                    $success = 'Félicitations le texte a été modifié';
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
                            <a href="../home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
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

                    

                            <div class="col-md-6 col-xs-12">
                                <div class="col-md-12 panel panel-default r-p">

                                <div class="panel-heading">
                                    <h1 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Détail du texte</h1>
                                </div>
                                <div>
                                    <form class="form-horizontal col-sm-12 uppicture" method="post" enctype="multipart/form-data">

                                        <!-- Titre -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Titre :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" value="<?=$text['text_title']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Taille -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-commenting" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" value="<?=$text['text_description']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Texte Actuel :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                    <textarea rows="5" type="text" class="form-control" disabled><?=$text['text_content']; ?></textarea>
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

                                        <!-- Image -->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Nouveau Texte :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                    <textarea type="text" rows="5" class="form-control" name="text_content"></textarea>
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