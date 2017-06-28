
<?php
session_name('wmd');session_start();

require('include/connect.php');
require('include/home_edit.php');
require('include/route.php');

?>

<html lang="fr" class="full-height">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>WelcoMed</title>

        <!-- Ajouter des meta -->

        <!-- Police Roboto -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap4.min.css" rel="stylesheet">
       
        <!-- Material Design Bootstrap -->
        <link href="css/mdb.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/modal-style.css" rel="stylesheet">

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

                    <a class="navbar-brand" href="./">
                        <strong><img src="img/logomin.png" class="welcologo"/></strong>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <!--Links-->
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">Accueil <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#footer" data-offset="100">Contactez-nous</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link wcomlink" href="#about">Welcomed Community</a>
                            </li>
                        </ul>

                        <!--Social Icons-->
                        <ul id="navrefresh" class="navbar-nav">
                            <li>
                                <?php if(!isset($_SESSION['user'])){?>
                                    <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>
                                    
                                    <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
                                    <?php }else{?> 
                                       
                                        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>ad1.php" data-toggle="modal" data-target="#modal4all">Publier une annonce</a>     
                                        
                                        <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>logout.php" data-toggle="modal" data-target="#modal4all">Se déconnecter</a>
                                        
                                    
                                <?php }?>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!--/Navbar-->

            <!--Mask-->
            <div class="view intro" id="home" style="background-image:url('<?php echo "img/".$imgOne['img_url']; ?>');">
                <div class="hm-black-strong-1">
                    <div class="full-bg-img flex-center">
                        <div class="container">
                            <div class="row smooth-scroll">
                                <div class="col-md-12 text-center pt-3 wow fadeIn" data-wow-delay="0.2s">
                                    <h1 class="white-text brand-name font-up font-bold hwelcomed"><?php echo $home_title['text_content']; ?></h1>
                                    <div class="row">
                                        <div class="col-md-12 div-color">
                                            <div class="divider-new div-blue">
                                                <i class="fa fa-heartbeat fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="font-up white-text mb-2 hwelcomed"><?php echo $home_slogan['text_content']; ?></h2>
                                    
                                    <?php if(!isset($_SESSION['user'])){?>
                                    <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>
									
                                    <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
                                    <?php }else{?>
                                    
                                    
										<a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>ad1.php" data-toggle="modal" data-target="#modal4all">Publier une Annonce</a>
										                                    	

										<a href="<?= $r ?>search.php" target="_self" class="btn wmregister" data-offset="100">Voir les offres</a>                                   	
										<a href="<?= $r ?>account.php" target="_self" class="btn wmregister" data-offset="100">Mon Compte</a>                                   	
                       
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
                                    <img src="<?php echo "img/".$minOne['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
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
                                    <img src="<?php echo "img/".$minTwo['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
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
                                    <img src="<?php echo "img/".$minThree['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
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
                                    <img src="<?php echo "img/".$minFour['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
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
                                    <img src="<?php echo "img/".$minFive['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/Card image-->

                                <!--Card content-->
                                <div class="card-block text-center">
                                    <!--Title-->
                                    <h4 class="card-title"><strong>Podologues</strong></h4>

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
                                    <img src="<?php echo "img/".$minSix['img_url']; ?>" class="img-fluid">
                                    <a href="<?=$r;?>search.php">
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

                    <?php if(!empty($onePub['partner']) || !empty($twoPub['partner'])):?>
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <div class="row text-center">
                            <?php if(!empty($onePub['partner']) && empty($twoPub['partner'])):?>
                                <?php echo '<div class="col-xs-12"><a href="'.$onePub['partner_link'].'"><img src="img/'.$onePub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$onePub['description'].'</p></a></div>'; ?>
                                <?php elseif(empty($onePub['partner']) && !empty($twoPub['partner'])) :?>
                                    <?php echo '<div class="col-xs-12"><a href="'.$twoPub['partner_link'].'"><img src="img/'.$twoPub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$twoPub['description'].'</p></a></div>'; ?>
                                    <?php elseif(!empty($onePub['partner']) && !empty($twoPub['partner'])) :?>
                                        <?php echo '<div class="col-xs-6"><a href="'.$onePub['partner_link'].'"><img src="img/'.$onePub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$onePub['description'].'</p></a></div><div class="col-xs-6"><a href="'.$twoPub['partner_link'].'"><img src="img/'.$twoPub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$twoPub['description'].'</p></a></div>'; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </section>
                <!--Section: Products-->
                

            </div>
            <!--/First container-->
            
           
          	<!--Streak-->
            <div class="streak streak-photo streak-large view photo-1 hr-streak" id="about" style="background-image:url('<?php echo "img/".$imgTwo['img_url']; ?>');">
                <div class="hm-black-strong-1">
                    <div class="mask flex-center">
                        <div class="container">
                            <!--First row-->
                            <div class="row text-white flex-center text-center mt-1 wow fadeIn" data-wow-delay="0.4s">
                            <hr class="hr-light w-100">
                                <h1 class="brand-name font-up"><?php echo $home_titleTwo['text_content']; ?></h1>
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
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s"><?php echo $home_titleTwoD['text_content']; ?></h1>

                    <!--Section description-->
                    <p class="text-center font-up font-bold mb-4 wow fadeIn" data-wow-delay="0.2s">...</p>

                    <!--First row-->
                    <div class="row">

                        <!--First column column-->
                        <div class="col-xl-5 col-lg-6 pb-1 wow fadeIn" data-wow-delay="0.4s">

                            <!--Description-->
                            <p align="justify"><?php echo $home_paraOne['text_content']; ?></p>

                            <p align="justify"><?php echo $home_paraTwo['text_content']; ?></p>

                            <p align="justify"><?php echo $home_paraThree['text_content']; ?></p>

                        </div>
                        <!--/First column-->

                        <!--Column column-->
                        <div class="col-xl-5 offset-xl-1 col-lg-6 wow fadeIn" data-wow-delay="0.4s">

                            <!--Image-->
                            <img src="<?php echo "img/".$minWC['img_url']; ?>" class="img-fluid" alt="My photo">

                        </div>
                        <!--/Column column-->

                    </div>
                    <!--/First row-->

                </section>
                <!--/Section: About-->
                <?php if(!empty($threePub['partner']) || !empty($fourPub['partner'])):?>
                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <div class="row text-center">
                            <?php if(!empty($threePub['partner']) && empty($fourPub['partner'])):?>
                                <?php echo '<div class="col-xs-12"><a href="'.$threePub['partner_link'].'"><img src="img/'.$threePub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$threePub['description'].'</p></a></div>'; ?>
                                <?php elseif(empty($threePub['partner']) && !empty($fourPub['partner'])) :?>
                                    <?php echo '<div class="col-xs-12"><a href="'.$fourPub['partner_link'].'"><img src="img/'.$fourPub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$fourPub['description'].'</p></a></div>'; ?>
                                    <?php elseif(!empty($threePub['partner']) && !empty($fourPub['partner'])) :?>
                                        <?php echo '<div class="col-xs-6"><a href="'.$threePub['partner_link'].'"><img src="img/'.$threePub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$threePub['description'].'</p></a></div><div class="col-xs-6"><a href="'.$fourPub['partner_link'].'"><img src="img/'.$fourPub['partner_picture'].'" class="img-responsive partnerimg"><p>'.$fourPub['description'].'</p></a></div>'; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

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
                                    <img src="img/profile-man.jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4><?php echo $home_respOne['text_content']; ?></h4>
                                <p><i class="fa fa-quote-left"></i> <?php echo $home_respOneT['text_content']; ?></p>
                            </div>
                        </div>
                        <!--/First column-->

                        <!--Second column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="img/profile-woman.jpg" class="rounded-circle img-fluid">
                                </div>

                                <!--Content-->
                                <h4><?php echo $home_respTwo['text_content']; ?></h4>
                                <p><i class="fa fa-quote-left"></i> <?php echo $home_respTwoT['text_content']; ?></p>
                            </div>
                        </div>
                        <!--/Second column-->

                        <!--Third column-->
                        <div class="col-md-4 mb-r wow fadeIn" data-wow-delay="0.4s">
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar">
                                    <img src="img/profile-woman.jpg" class="rounded-circle img-fluid">
                                </div>
                                <!--Content-->
                                <h4><?php echo $home_respThree['text_content']; ?></h4>
                                <p><i class="fa fa-quote-left"></i> <?php echo $home_respThreeT['text_content']; ?></p>

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
        
       


<?php	require('include/footer.php'); ?>
	
	<script>
			
		$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});		
	
	</script>

    </body>

</html>