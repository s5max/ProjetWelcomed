<?php
session_name('wmd');session_start();
    require('include/connect.php');
    require('include/header.php');

   if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])){

       $idUser = (int) $_SESSION['user']['id'];

       // Jointure SQL permettant de récupérer la recette & le prénom & nom de l'utilisateur l'ayant publié
       $selectOne = $bdd->prepare('SELECT u.* FROM user AS u WHERE id = :id');
       $selectOne->bindValue(':id', $idUser, PDO::PARAM_INT);
       if($selectOne->execute()){
           $user = $selectOne->fetch(PDO::FETCH_ASSOC);
       }
       else {
           // Erreur de développement
           var_dump($selectOne->errorInfo());
           die; // alias de exit(); => die('Hello world');
       }
   }



	$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$professionAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

	$select = $bdd->prepare('SELECT * FROM offer');

	if($select->execute()){

		$offerAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

		$offer = [];
		$demand = [];
		foreach($offerAvailable as $value){
			if($value['id']<5){
				$offer[] = [$value['id'],$value['type']];
			}
			elseif($value['id']>4){
				$demand[] = [$value['id'],$value['type']];
			}
		}
		
	}

	$select = $bdd->prepare('SELECT * FROM city');

	if($select->execute()){

		$cityAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

?>
<!DOCTYPE html>
<html lang="en" class="full-height">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>WelcoMed</title>

        <!-- Meta OG -->
        <meta property="og:title" content="Material Design Organic Cafe Landing Page">
        <meta property="og:description" content="Perfect for projects that have something in common with cafe's and restaurants.">
        <meta property="og:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg">
        <meta property="og:url" content="https://mdbootstrap.com/live/_MDB/templates/Landing-Page/organic-cafe-landing-page.html">
        <meta property="og:site_name" content="mdbootstrap.com">
        <!-- /Meta OG -->

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="Perfect for projects that have something in common with cafe's and restaurants." />
        <meta name="twitter:title" content="Material Design Organic Cafe Landing Page" />
        <meta name="twitter:site" content="@MDBootstrap" />
        <meta name="twitter:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg" />
        <meta name="twitter:creator" content="@MDBootstrap" />
        <!-- /Twitter Card -->    

        <!-- Police Roboto -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <!-- <link href="css/bootstrap337.css" rel="stylesheet"> -->
        <link href='css/bootstrap.css' rel='stylesheet' />
        <link href="css/bootstrap4.min.css" rel="stylesheet"/>
        <link href='css/rotating.css' rel='stylesheet' />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/>

        <!-- Material Design Bootstrap -->
        <link href="css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">
        
        <style>
		
			.lbl {
				color: #757575;
				font-size: 1rem;
				margin-bottom: 0rem;
				font-weight: bold;
			}
			
			.option {
				padding: 10px;
			}
			
			.option > span {
				padding: 8px;
				border: solid #ccc 1px;
				border-radius: 2px;
				color: #ccc;
				cursor: pointer;
			}
		
			.blind {
				display:none;
			}
			
			.sight {
				display:block;
			}
		
		</style>

    </head>

    <body class="cyan-skin intro-page cafe-lp">
 
       
        <?php include 'include/head.php'; ?>

        
        <!--Modal Reservation-->
            <div class="modal fade modal-ext" id="modal-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Formulaire d'inscription</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-content">
                            
                            <form id="subscribe" method="post" enctype="multipart/form-data">
                                
                                <select class="mdb-select colorful-select dropdown-default" name="profession1" id="profession1">
                                <option value="none">--- Choisir votre profession ---</option>
                                <?php foreach($professionAvailable as $value){ echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';} ?>
                                </select>
                                
                                <div class="md-form">
                                    <input type="text" name="firstname" id="firstname" class="form-control">
                                    <label for="firstname">Votre Nom</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="lastname" id="lastname" class="form-control">
                                    <label for="lastname">Votre Prénom</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="address" id="address" class="form-control">
                                    <label for="address">Adresse</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="zipcode" id="zipcode" class="form-control">
                                    <label for="zipcode">Code Postal</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="city1" id="city1" class="form-control">
                                    <label for="city1">Ville</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="department1" id="department1" class="form-control">
                                    <span><label for="department1">Département</label></span>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="telephone" id="telephone1" class="form-control">
                                    <label for="telephone1">Téléphone</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="email" id="email1" class="form-control">
                                    <label for="email1">Email</label>
                                </div>

                                <div class="md-form">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <label for="password">Mot de Passe</label>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-lg btn-rounded btn-primary" id="sbt">S'inscrire</button>
                            <!--                                <p class="text-muted">*Some dummy text goes here.</p>-->
                                </div>
                            </form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/Content-->
                </div>
            </div>
            <!--/Modal Reservation-->
            
            
            
            <!--Modal step 1-->
            <div class="modal fade modal-ext" id="modal-step1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 1/4</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step1-content">
                        
                        	<form id="step1Form" method="post" enctype="multipart/form-data">
                        	
								<select name="type" id="type" class="form-control">
									<option value="none" selected disabled>-- Type d'annonce --</option>
													<!-- On réutilise notre array() ci-dessus -->
									<optgroup label="Offre">
									<?php foreach($offer as $value){
											echo'<option value="'.$value[0].'">'.$value[1].'</option>';

										}//End foreach ?>
									<optgroup label="Demande">
									<?php foreach($demand as $value){
											echo'<option value="'.$value[0].'">'.$value[1].'</option>';

									}//End foreach ?>
								</select>

								<select name="profession" id="profession" class="form-control">
										<option value="none">--- Choisir votre proffession ---</option>
										<?php foreach($professionAvailable as $value){ echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';} ?>
								</select>

								<div class="md-form">
									<input type="text" id="department" name="department" class="form-control" value="Martinique" disabled>
									<label for="department">Département</label>
								</div>

								<div class="md-form">
									<select name="city" id="city" class="form-control">
										<option value="none" selected disabled>-- Commune --</option>
										<?php foreach ($cityAvailable as $value): ?>
											<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="md-form">
									<input type="text" name="date_start" id="date_start" placeholder="jj/mm/aaaa">
									<label for="date_start">Date de début</label>
								</div>

								<div class="md-form">
									<input type="text" name="date_end" id="date_end" placeholder="jj/mm/aaaa">
									<label for="date_end">Date de fin</label>
								</div>

								<div class="text-center">

									<button id="step1" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 1-->
           
           
           
           
           	<!--Modal step 2-->
            <div class="modal fade modal-ext" id="modal-step2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 2/4</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step2-content">
                        
                        	<form id="step2Form" method="post" enctype="multipart/form-data">
                        	
								<div class="md-form">
									<label for="opening">Heure d'Ouverture</label>
									<input type="text" name="opening" id="opening" placeholder="hh:mm">
								</div>

								<div class="md-form">
									<label for="closing">Heure de Fermeture</label>
									<input type="text" name="closing" id="closing" placeholder="hh:mm">
								</div>
								
								
								<p class="lbl">Présence d'une secrétaire</p>
								
								<div class="option">
									<span class="option" data-id="secretary" data-info="on">Oui</span>
									<span class="option" data-id="secretary" data-info="off">Non</span>
								</div>

								
								<p class="lbl">Règlements acceptés</p>
								
								<div class="option">
									<span class="option2" data-id="cb" data-info="on">CB</span>
									<span class="option2" data-id="check" data-info="on">Chèques</span>
									<span class="option2" data-id="cash" data-info="on">Espèces</span>
								</div>


								<p class="lbl">Accès Handicapé</p>
								
								<div class="option">
									<span class="option" data-id="access" data-info="on">Oui</span>
									<span class="option" data-id="access" data-info="off">Non</span>
								</div>

								<div class="text-center">

									<button id="step2" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer *</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 2-->
            
            
            
            <!--Modal step 3 -->
            <div class="modal fade modal-ext" id="modal-step3a" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 3/4</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step3-content">
                        	<!-- assistanat / remplacement -->
                        	<form class="blind" id="step3aForm" method="post" enctype="multipart/form-data">
                        	
								<p class="lbl">Lieu de consultation</p>
								
								<div class="option">
									<span class="option2" data-id="office" data-info="on">Cabinet</span>
									<span class="option2" data-id="home" data-info="on">Domicile(patient)</span>
								</div>

								<div class="md-form">
									<input type="number" name="hour" id="hour" class="form-control">
									<label for="hour">Heures travaillées / Semaine</label>
								</div>

								<div class="md-form">
									<input type="number" name="patient" id="patient" class="form-control">
									<label for="patient">Patients / Jour </label>
								</div>

								<div class="md-form">
									<input type="number" name="salary" id="salary" class="form-control">
									<label for="salary">Salaire / Mois</label>
								</div>

								<div class="md-form">
									<input type="number" name="retrocession" id="retrocession" class="form-control">
									<label for="retrocession">Rétrocession</label>
								</div>

<!--								<label for="exercise">Type d'exercice</label>-->
								<select name="exercise" id="exercise" class="form-control">
									<option value="0" selected disabled>Sélectionner...</option>
									<option value="SDF">SDF</option>
									<option value="SCP">SCP</option>
									<option value="SCM">SCM</option>
									<option value="SEL">SEL</option>
									<option value="SDP">SDP</option>
									<option value="GIE">GIE</option>
									<option value="Pôle de santé">Pôle de santé</option>
									<option value="Individuel">Individuel</option>
								</select>
        
								<div class="md-form">
									<input type="number" name="nbPraticioner" id="nbPraticioner" class="form-control">
									<label for="nbPraticioner">Nombre de praticiens</label>
								</div>

								<div class="md-form">
									<input type="text" name="software" id="software" class="form-control">
									<label for="software">Logiciel utilisé</label>
								</div>
                      
							</form>
							
							<form class="blind" id="step3bForm" method="post" enctype="multipart/form-data">
							
								<div class="md-form">
									<input type="number" name="sales" id="sales" class="form-control">
									<label for="Chiffre_d'affaires">Chiffre d'affaires</label>
								</div>

								<div class="md-form">
									<input type="number" name="partner" id="partner" class="form-control">
									<label for="Nombres_d'associés">Nombres d'associés</label>
								</div>
								
								<div class="option">
									<span class="option2" data-id="office" data-info="on">Cabinet</span>
									<span class="option2" data-id="home" data-info="on">Domicile(patient)</span>
								</div>
								
								<div class="md-form">
									<input type="number" name="patient" id="patient" class="form-control">
									<label for="patient">Patients / Jour </label>
								</div>
								
<!--							<label for="exercise">Type d'exercice</label>-->
								<select name="exercise" id="exercise" class="form-control">
									<option value="0" selected disabled>Sélectionner...</option>
									<option value="SDF">SDF</option>
									<option value="SCP">SCP</option>
									<option value="SCM">SCM</option>
									<option value="SEL">SEL</option>
									<option value="SDP">SDP</option>
									<option value="GIE">GIE</option>
									<option value="Pôle de santé">Pôle de santé</option>
									<option value="Individuel">Individuel</option>
								</select>
        
								<div class="md-form">
									<input type="number" name="nbPraticioner" id="nbPraticioner" class="form-control">
									<label for="nbPraticioner">Nombre de praticiens</label>
								</div>

								<div class="md-form">
									<input type="text" name="software" id="software" class="form-control">
									<label for="software">Logiciel utilisé</label>
								</div>
								
							</form>
							
							<form class="blind" id="step3cForm" method="post" enctype="multipart/form-data">
							
								<select name="contract" id="contract" class="form-control">
									<option value="0" selected disabled>--- Type de Contrat ---</option>
									<option value="CDD">CDD</option>
									<option value="CDI">CDI</option>
									<option value="Remplacement">Remplacement</option>
									<option value="Autre">Autre</option>
								</select>
								
								<div class="md-form">
									<input type="text" name="company" id="company" class="form-control">
									<label for="company">Entreprise</label>
								</div>
								
								<div class="md-form">
									<input type="number" name="salary" id="salary" class="form-control">
									<label for="salary">Salaire / Mois</label>
								</div>

								<div class="md-form">
									<input type="number" name="retrocession" id="retrocession" class="form-control">
									<label for="retrocession">Rétrocession</label>
								</div>
								
								<select name="Type_de_journée" id="Type_de_journée" class="form-control">
									<option value="0" selected disabled>--- Type de journée ---</option>
									<option value="Mi-Temps">Mi-temps</option>
									<option value="Temps Plein">Temps plein</option>
								</select>
								
<!--							<label for="exercise">Type d'exercice</label>-->
								<select name="exercise" id="exercise" class="form-control">
									<option value="0" selected disabled>Sélectionner...</option>
									<option value="SDF">SDF</option>
									<option value="SCP">SCP</option>
									<option value="SCM">SCM</option>
									<option value="SEL">SEL</option>
									<option value="SDP">SDP</option>
									<option value="GIE">GIE</option>
									<option value="Pôle de santé">Pôle de santé</option>
									<option value="Individuel">Individuel</option>
								</select>
        
								<div class="md-form">
									<input type="number" name="nbPraticioner" id="nbPraticioner" class="form-control">
									<label for="nbPraticioner">Nombre de praticiens</label>
								</div>

								<div class="md-form">
									<input type="text" name="software" id="software" class="form-control">
									<label for="software">Logiciel utilisé</label>
								</div>
							
							</form>
							
							
							
							<div class="text-center">

								<button id="step3" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

							</div>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 3a-->
           
           
           <!--Modal step 4-->
            <div class="modal fade modal-ext" id="modal-step4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                       <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title w-100">Publier une annonce : Etape 4/4</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body" id="modal-step4-content">
                        
                        	<form id="step4Form" method="post" enctype="multipart/form-data">
                        	
								<div class="md-form">
									<input type="text" name="title" id="title">
									<label for="title">Titre de l'Annonce</label>
								</div>

								<div class="md-form">
									<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
									<label for="description">Description</label>
								</div>

								<div class="md-form">
									<input type="text" name="name" id="name" value="<?= ucfirst($_SESSION['user']['firstname']); ?>" class="form-control">
									<label for="name">Nom de contact</label>
								</div>

								<div class="md-form">
									<input type="text" name="email" id="email" value="<?= $_SESSION['user']['email']; ?>" class="form-control">
									<label for="email">Email</label>
								</div>

								<div class="md-form">
									<input type="text" name="telephone" id="telephone" value="<?= $_SESSION['user']['telephone']; ?>" class="form-control">
									<label for="telephone">Téléphone</label>
								</div>

								<div class="text-center">

									<button id="step4" class="btn btn-lg btn-rounded btn-primary">Suivant</button>

								</div>
                      
							</form>
                       
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer*</button>
                            <p class="text-muted">*Les informations ne seront pas enregistrées</p>
                        </div>
                        
 		            </div>
                    <!--/Content-->
                </div>
            </div>
			<!--/Modal step 4-->
        

        <!--Main content-->
        <main class=" normalsection">

            <!--First container-->
            <div class="container normalsection">

                <!--Section: Features v.4-->
                <section class="section mt-4 feature-box col-xs-12 normalsection" id="features">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">WELCOMED</h1><br>

                    <!-- Recherche -->

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->

                

            </div>
            <!--/First container-->

            <!--Second container-->
            <div class="container-full whitesection">
                <div class="container">

                    <!--Section: About-->
                    <section class="section about mb-4" id="about"> 

                        <div class="row">
                            <h1 class="title normaltitle">Mon Compte</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Utilisateur :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['lastname'].' '.$user['firstname']; ?></h2>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Spécialité :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['profession']; ?></h2>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Téléphone :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['telephone']; ?></h2>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Email :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['email']; ?></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Adresse :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['address']; ?></h2>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Ville :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['city']; ?></h2>
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Code Postal :</h4>
                                                </li>
                                            </ol>
                                            <h2><?php echo $user['zipcode'].' '.$user['department']; ?></h2>
                                        </div>
                                </div>
                            </div>

                    </section>
                    <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->

            </div>
            <!--/Second container-->

        </main>
        <!--/Main content-->

        <?php include 'include/footer.php'; ?>

        <script>

            //Animation init
            new WOW().init();

            // Material Select Initialization
            $(document).ready(function() {
                $('.mdb-select').material_select();
            });

        </script>


<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46172202-4', 'auto');
  ga('send', 'pageview');

</script>
   
    
<script>
	
	var reference = {};
	
	$('.option>span.option').click(function(e){
        $(this).siblings().css('border','solid #ccc 1px');
        $(this).css('border','solid #757575 2px');
		$(this).css('color','#757575');
		
        
        var key     = $(this).data('id');
        var value   = $(this).data('info');
		
		reference[key] = value;
		
	});
	
	$('.option>span.option2').click(function(e){
        
        $(this).css('border','solid #757575 2px');
		$(this).css('color','#757575');
		
        
        var key     = $(this).data('id');
        var value   = $(this).data('info');
		
		reference[key] = value;
		
	});
				
	$('#step1').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step1.php',
			data	: {
				
				type		: $('#type').val(),
				profession	: $('#profession').val(),
				department	: $('#department').val(),
				city		: $('#city').val(),
				date_start	: $('#date_start').val(),
				date_end	: $('#date_end').val()
			},
			success : function(o){
				
				$('#modal-step1-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
	
	
	$('#step2').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step2.php',
			data	: {
				
				opening: $('#opening').val(),
				closing: $('#closing').val(),
				secretary:reference['secretary'],
				cb:reference['cb'],
				check:reference['check'],
				cash:reference['cash'],
				access:reference['access'],
				
			},
			success : function(o){
				
				$('#modal-step2-content').prepend('<p class="text-danger">'+o+'</p>');
				var kind = $('#kind').text();
				if(kind === '1'){$('#step3aForm').removeClass('blind');}else if(kind === '2'){$('#step3bForm').removeClass('blind');}else if(kind === '3'){$('#step3cForm').removeClass('blind');}
			}
			
		});
		
	});
	
	
	$('#step3').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step3.php',
			data	: {
				
				office:reference['office'],		
				home:reference['home'],		
				hour: $('#hour').val(),
				patient: $('#patient').val(),
				salary: $('#salary').val(),
				retrocession: $('#retrocession').val(),
				exercise: $('#exercise').val(),
				nbPraticioner: $('#nbPraticioner').val(),
				software: $('#software').val(),
				
			},
			success : function(o){
				console.log()
				$('#modal-step3-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});
	
	$('#step4').on('click',function(e){
		
		e.preventDefault();
		
		$.ajax({
			
			type	: 'post',
			url		: '/git/welco-med/import/check_step4.php',
			data	: {
				
						title: $('#title').val(),
						description: $('#description').val(),
						name: $('#name').val(),
						email:$('#email').val(),
						telephone:$('#telephone').val(),
						
				
			},
			success : function(o){
				console.log()
				$('#modal-step4-content').prepend('<p class="text-danger">'+o+'</p>');
			}
			
		});
		
	});

				
</script>
    
    

    </body>

</html>