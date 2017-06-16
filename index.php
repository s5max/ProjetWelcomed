
<?php
session_name('wmd');session_start();

$m = '/welcome/modal/';

require('include/connect.php');

?>

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

        <!-- Twitter Card -->
<!--
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="Perfect for projects that have something in common with cafe's and restaurants." />
        <meta name="twitter:title" content="Material Design Organic Cafe Landing Page" />
        <meta name="twitter:site" content="@MDBootstrap" />
        <meta name="twitter:image" content="https://mdbootstrap.com/img/Live/MDB/13.03/cafe-fb.jpg" />
        <meta name="twitter:creator" content="@MDBootstrap" />
-->
        <!-- /Twitter Card -->    

        <!-- Police Roboto -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <!-- <link href="css/bootstrap337.css" rel="stylesheet"> -->
        <link href="css/bootstrap4.min.css" rel="stylesheet">
       
        <!-- Material Design Bootstrap -->
        <link href="css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">
        
        <style>
			select{cursor: pointer}
			.note{text-align: right;font-size: 0.8rem;color:#4fada7}
			.error{text-align: center;color: #961b25}
			.valid{top:-5px !important;color:#4fada7 !important}
			.pad-right{padding-right: 20px}
			.done{padding-top: 15px;text-align: center;}
			.done>h4{color:#4fada7}
			.formule{height: auto;margin-bottom:10px;padding:10px;border:1px solid #eceeef;border-radius:3px;overflow: hidden;}
			.formule>a{float:right}
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
			
			.lien{
				color:#4fada7;
				text-decoration:underline;
			}
		</style>
    
    	

    </head>
    
	    <body class="cyan-skin intro-page cafe-lp">

        <!--Navigation & Intro-->
        <header>

            <!--Navbar-->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar">

                <div class="container">

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> 
                    </button>

                    <a class="navbar-brand" href="#">
                        <strong><img src="img/logomin.png" class="welcologo"/></strong>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <!--Links-->
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">Accueil <span class="sr-only">(current)</span></a>
                            </li>
<!--
                            <li class="nav-item">
                                <a class="nav-link" href="ad/index.php">Voir les offres</a>
                            </li>
-->
                            <li class="nav-item">
                                <a class="nav-link" href="#footer" data-offset="100">Contactez-nous</a>
                            </li>
<!--
                            <li class="nav-item">
                                <a class="nav-link" href="#products" data-offset="100">Publier une annonce</a>
                            </li>
--> 
                            <li class="nav-item">
                                <a class="nav-link wcomlink" href="#about">Welcomed Community</a>
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

            <!--Mask-->
            <div class="view intro" id="home">
                <div class="hm-black-strong-1">
                    <div class="full-bg-img flex-center">
                        <div class="container">
                            <div class="row smooth-scroll">
                                <div class="col-md-12 text-center pt-3 wow fadeIn" data-wow-delay="0.2s">
                                    <h1 class="white-text brand-name font-up font-bold hwelcomed">Welcomed</h1>
                                    <div class="row">
                                        <div class="col-md-12 div-color">
                                            <div class="divider-new div-blue">
                                                <i class="fa fa-heartbeat fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="font-up white-text mb-2 hwelcomed">Une expérience libérale sous le Soleil de Martinique</h2>
                                    
                                    <?php if(!isset($_SESSION['user'])){?>
                                    <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>
									
                                    <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
                                    <?php }else{?>
                                    
                                    
										<a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>ad1.php" data-toggle="modal" data-target="#modal4all">Publier une Annonce</a>
										                                    	
										<a href="search.php" class="btn wmlogin" data-offset="100" data-toggle="modal" data-target="#modal4all">Voir les offres</a>                                    	
                                    	
                                    	<a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>logout.php" data-toggle="modal" data-target="#modal4all">Se déconnecter</a>
                                    
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                

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
         
                       
                           
                        
        <!--Main content-->
        <main>

            <!--First container-->
            <div class="container">

                <!--Section: Features v.4-->

                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->
                <section class="section" id="products">

                    <!--Secion heading-->
                    <!-- <h1 class="text-center font-up font-bold mt-5 wow fadeIn" data-wow-delay="0.2s">&nbsp; </h1> -->

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">&nbsp; </p>

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-lg-4 col-md-12 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-doc.jpg" class="img-fluid">
                                    <a href="page.php">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Médecins</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-kiné.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Kinésithérapeutes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-nurse.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Infirmiers / ères</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                    </div>
                    <!--/First row-->

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-lg-4 col-md-12 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-ortho.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Orthophonistes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-pedi.jpg" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Podologue</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                        <!--First column-->
                        <div class="col-lg-4 col-md-6 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <!--Card-->
                            <div class="card card-cascade wider">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="img/pic-dentist.png" class="img-fluid">
                                    <a href="#!">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Chirurgiens-dentistes</strong></h4>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->


                        </div>
                        <!--/First column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--Section: Products-->
                

            </div>
            <!--/First container-->
            
           
          	<!--Streak-->
            <div class="streak streak-photo streak-large view photo-1 hr-streak" id="about">
                <div class="hm-black-strong-1">
                    <div class="mask flex-center">
                        <div class="container">
                            <!--First row-->
                            <div class="row text-white flex-center text-center mt-1 wow fadeIn" data-wow-delay="0.4s">
                                <h1 class="brand-name font-up">Welcomed Community</h1>
                                <hr class="hr-light w-100">
                                <h2 class="font-up pt-1"><strong>...</strong></h2>
                            </div>
                            <!--/First row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--/Streak-->
            
           
            <!--Second container-->
            <div class="container">

                <!--Section: About-->
                <section class="section about mb-4"> 

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Qu'Est-ce que la Welcomed Community</h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">...</p>

                    <!--First row-->
                    <div class="row">

                        <!--First column column-->
                        <div class="col-xl-5 col-lg-6 pb-1 wow fadeIn" data-wow-delay="0.4s">

                            <!--Description-->
                            <p align="justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque animi maxime.</p>

                            <p align="justify">Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque delectus, beatae maxime temporibus maiores quibusdam quasi rem magnam ad perferendis iusto sint tempora.</p>

                            <ul>
                                <li>Nemo animi soluta ratione</li>
                                <li>Beatae maxime temporibus</li>
                                <li>Consectetur adipisicing elit</li>
                            </ul>

                        </div>
                        <!--/First column-->

                        <!--Column column-->
                        <div class="col-xl-5 offset-xl-1 col-lg-6 wow fadeIn" data-wow-delay="0.4s">

                            <!--Image-->
                            <img src="img/wmcommunity.jpg" class="img-fluid" alt="My photo">

                        </div>
                        <!--/Column column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->
                <section class="section team-section" id="testimonials">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Témoignages</h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">Ce qu'ils ont à en dire</p>

                    <!--First row-->
                    <div class="row text-center">

                        <!--First column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">

                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(20).jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4>Anna Deynah</h4>
                                <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab.</p>
                            </div>
                        </div>
                        <!--/First column-->

                        <!--Second column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4>John Doe</h4>
                                <p><i class="fa fa-quote-left"></i> Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi.</p>
                            </div>
                        </div>
                        <!--/Second column-->

                        <!--Third column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(19).jpg" class="rounded-circle img-fluid">
                                </div>
                                <!--Content-->
                                <h4>Maria Kate</h4>
                                <p><i class="fa fa-quote-left"></i> At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>

                            </div>
                        </div>
                        <!--/Third column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--/Section: Testimonials v.3-->

            </div>
            <!--/Second container-->

        </main>
        <!--/Main content-->
        
       
        <!--Footer-->
        <footer class="page-footer footer-tiles center-on-small-only pt-4" id="footer">

            <!--Footer Links-->
            <div class="container mb-4">

                <!--First row-->
                <div class="row">

                    <!--First column-->
                    <div class="col-xl-4 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <a class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-subscribe">Inscription</a>
                        
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                        <!--About-->
<!--
                        <h5 class="title mb-1"><strong>A PROPOS DE NOUS</strong></h5>

                        <p>A remplir !</p>

                        <p class="mb-1-half"> A remplir !</p>
-->
                        <!--/About -->

                    
                    </div>
                    <!--/First column-->

                    <hr class="w-100 hidden-lg-up">

                    <!--Second column-->
                    <div class="col-xl-3 offset-xl-1 col-lg-4 col-md-6 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <div class="footer-socials">

                            <!--Facebook-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-facebook"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-google-plus"></i></a>

                        </div>
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <!--Info-->
                        <p><i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>

                    </div>
                    <!--/Second column-->

                    <hr class="w-100 hidden-md-up">

                    <!--First column-->
                    <div class="col-xl-3 offset-xl-1 col-lg-4 col-md-6 t-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <!--Title-->
                        <h5 class="title mb-2"><strong>Dernières recherches</strong></h5>

                        <!--Opening hours table-->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Médecins</td>
                                </tr>
                                <tr>
                                    <td>Chirurgiens-dentistes</td>
                                </tr>
                                <tr>
                                    <td>Orthophonistes</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!--/First column-->

                </div>
                <!--/First row-->

            </div>
            <!--/Footer Links-->

            <!--Copyright-->
            <div class="footer-copyright wow fadeIn" data-wow-delay="0.3s">
                <div class="container-fluid">
                    <p>© 2017 Copyright: Welcomed</p>
                </div>
            </div>
            <!--/Copyright-->

        </footer>
        <!--/Footer Links-->

<?php	require('include/script.php'); ?>
			

    </body>

</html>