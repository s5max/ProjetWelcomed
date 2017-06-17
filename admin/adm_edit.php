<?php
    require('../include/connect.php');
    require('../include/header.php');
    require('include/log.php');

    $select = $bdd->prepare('SELECT * FROM pictures ORDER BY img_id ASC');

    if($select->execute()){
        $pictures = $select->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        echo 'Une erreur s\'est produite!';
        die; //alias de exit(); => die('Hello World');
    }

?>
<?php include '../include/adminhead.php'; ?>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Panneau D'Administration</a>
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
                        <li>
                            <a href="adm_partners.php"><i class="fa fa-handshake-o"></i> Partenariats</a>
                        </li>
                        <li class="active">
                            <a href="adm_edit.php"><i class="fa fa-paint-brush"></i> Personnalisation</a>
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
                                    <i class="fa fa-dashboard"> Personnalisation</i> 
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <table class="table table-inverse table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Détail</th>
                                <!-- <th>Supprimer</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <!-- foreach permettant d'avoir une ligne <tr> par ligne SQL -->
                            <?php foreach($pictures as $picture): ?>

                                <tr>
                                    <td><?=$picture['img_id']; ?></td>
                                    <td><?=$picture['title']; ?></td>
                                    <td>
                                        <a href="edit/adm_pictureupdate.php?id=<?=$picture['img_id']; ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
                
<?php include '../include/adminfooter.php'; ?>