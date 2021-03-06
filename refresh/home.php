<?php session_name('wmd'); session_start();?>
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
					<a class="btn wmregister mod" data-offset="100" data-toggle="modal" data-url="modal/subscribe.php" data-target="#modal4all">S'inscrire</a>

					<a class="btn wmlogin mod" data-offset="100" data-toggle="modal" data-url="modal/login.php" data-target="#modal4all">Se connecter</a>
					<?php }else{?>
					
						<a class="btn wmlogin mod" data-offset="100" data-toggle="modal" data-url="modal/ad1.php" data-target="#modal4all">Publier une Annonce</a>
						<a href="search.php" class="btn wmlogin" data-offset="100" >Voir les offres</a>
						<a class="btn wmlogin mod" data-offset="100" data-toggle="modal" data-url="modal/logout.php" data-target="#modal4all">Se déconnecter</a>

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