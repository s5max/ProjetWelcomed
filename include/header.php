<?php

	session_name('wmd');
	session_start();
	$r = '/Home/ProjetWelcomed/';

?>

<!DOCTYPE html>
<html lang="fr" class="full-height">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>WelcoMed</title>

        <!-- Meta OG -->
<!--
        <meta property="og:title" content="Material Design Organic Cafe Landing Page">
        <meta property="og:description" content="Perfect for projects that have something in common with cafe's and restaurants.">
        <meta property="og:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg">
        <meta property="og:url" content="https://mdbootstrap.com/live/_MDB/templates/Landing-Page/organic-cafe-landing-page.html">
        <meta property="og:site_name" content="mdbootstrap.com">
-->
        <!-- /Meta OG -->   

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

    </head>

    <body class="cyan-skin intro-page cafe-lp">

        <!--Navigation & Intro-->
        <header class="normalheader">

            <!--Navbar-->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark" id="normalnav">

                <div class="container">

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> 
                    </button>

                    <a class="navbar-brand" href="#">
                        <strong><img src="img/logomin.png" class="normallogo"/></strong>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <!--Links-->
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $r ?>">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#features">Voir les offres</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about" data-offset="100">Contactez-nous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#products" data-offset="100">Publier une annonce</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#testimonials" data-offset="100">Mon Compte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link wcomlink" href="#contact" data-target="#modal-contact">Welcomed Community</a>
                            </li>
                        </ul>

                        <!--Social Icons-->
                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!--/Navbar-->
          
		</header>
        <!--/Navigation & Intro-->

		<!--    Modal    -->
        <div class="modal fade modal-ext" id="modal4all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div id="ajax" class="modal-content" id="modal-content">
                    
                    	

                    <!-- 	Ajax    -->
                    
                    	
                        
                    </div>
                    <!--/Content-->
                </div>
         </div>
         <!--/Modal 	-->