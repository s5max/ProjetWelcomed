<?php session_name('wmd'); session_start();

//$m = '/git/ProjetWelcomed/modal/';
//$r = '/git/ProjetWelcomed/';
require('../include/connect.php');
require('../include/home_edit.php');

$m = '/Home/ProjetWelcomed/modal/';
$r = '/Home/ProjetWelcomed/';
?>


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
							                                    	

							<a href="<?= $r ?>search.php" target="_self" class="btn wmregister">Voir les offres</a>                                   	
							<a href="<?= $r ?>account.php" target="_self" class="btn wmregister">Mon Compte</a>   
                  			
                        <?php }?>

				</div>
			</div>
		</div>
	</div>
</div>


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