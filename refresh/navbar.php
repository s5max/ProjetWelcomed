<?php 
session_name('wmd'); session_start();

require('../include/route.php');

?>
<!--Links-->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $r ?>">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <?php if(isset($_SESSION['user'])){ echo '<a class="nav-link" href="search.php">Voir les offres</a>';}?>
                            </li>
                            <li class="nav-item">
                                <?php if(isset($_SESSION['user'])){echo '<a class="nav-link" href="account.php">Mon Compte</a>';}?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php" data-offset="100">Contactez-nous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link wcomlink" href="./#about" data-target="#modal-contact">Welcomed Community</a>
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


<script>
	
	$('.mod').on('click', function(e){
		
		e.preventDefault();
		
		url = this.getAttribute('data-url');
		
		$.ajax({
			type: 'post',
			url: url,
			success:function(o){
				$('#ajax').html(o);
			}
		});
		
	});

</script>