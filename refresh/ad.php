<?php 

session_name('wmd');session_start();

$m = '/git/ProjetWelcomed/modal/';

if(!empty($_POST)){
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
}

if(!isset($_SESSION['user'])){ ?>
							
		<a id="contact" class="btn btn-lg btn-rounded btn-primary waves-effect waves-light btn-contact mod" data-receiver="<?= if(isset($post)){$post['receiver_id'];} ?>" data-toggle="modal" data-target="#modal-contact" disabled>Contacter l'annonceur</a>

	<div id="no-log">

		<p>vous devez être inscrit(e) et connecté(e) pour contacter l\'annonceur</p>

		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="<?= $m ?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>

		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="<?= $m ?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
	</div>
<?php
}
else{
?>
	<a id="contact" class="btn btn-lg btn-rounded btn-primary waves-effect waves-light btn-contact mod" data-url="<?= $m ?>contact_advertiser.php" data-receiver="<?= if(isset($post)){$post['receiver_id'];} ?>" data-toggle="modal" data-target="#modal4all">Contacter l'annonceur</a>
<?php } ?>




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