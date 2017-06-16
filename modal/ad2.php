<?php

session_name('wmd');session_start();
require('../include/connect.php');

$empty = true;

if(!empty($_POST)){
	
	$empty = null;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	if(isset($post['opening'])){
	if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['opening'])){
		$error['opening'] = '<p class="error">L\'heure doit être au format de l\'exemple suivant : 09:00</p>';
	}
	}
	
	if(isset($post['closing'])){
	if(!preg_match('#^[0-9]{2}:[0-9]{2}$#',$post['closing'])){
		$error['closing'] = '<p class="error">L\'heure doit être au format de l\'exemple suivant : 09:00</p>';
	}
	}

	if(isset($post['secretary'])){ 
		if($post['secretary'] != 'on' && $post['secretary'] != 'off'){
		$error['secretary'] = '<p class="error">Paramètre invalide</p>';
		}
	}
	
	if(count($error) === 0){
			
		foreach($post as $k => $v){
			$_SESSION['post']['detail'][$k] = $v;
		}

	}
	
}

?>


<!--Header-->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title w-100">Choisissez votre formule de publication (2/3)</h4>
</div>
<!--Body-->
<div class="modal-body" id="modal-step2-content">
	
	
	<div class="formule">
		<h5>Formule Premium</h5>
		<p>En ligne 90 jours, classée en tête de liste (... jours après l'activation). En première page durant 30 jours.Le libellé est limité à 1500 caractères. Un diaporama de 6 photos accompagne l'annonce</p>
		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="" data-info="3" disabled>Acheter pour 90€ *</a>
		
	</div>
	<p class="note pad-right">* Bientôt disponible</p>
	
	<div class="formule">
		<h5>Formule Welcome</h5>
		<p>Annonce en ligne 30 jours, en première page 7 jours maximum. Le libellé est limité à 1000 caractères. Un diaporama de 6 photos accompagne l'annonce.</p>
		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="" data-info="2" disabled>Acheter pour 35€*</a>
	</div>
		<p class="note pad-right">* Bientôt disponible</p>
	
	<div class="formule">
		<h5>Formule Standard</h5>
		<p>Annonce en ligne 7 jours. Le libellé est limité à 200 caractères. Sans diaporama.</p>
		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="ad3.php" data-info="1">Continuer</a>
	</div>
	
</div>
<!--Footer-->
<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer </button>
</div>
	
	


<script>
	
	$('.mod').on('click', function(e){
		
		e.preventDefault();
		
		url = 'modal/'+this.getAttribute('data-url');
		console.log(url);
		$.ajax({
			type: 'post',
			url: url,
			success:function(o){
				
				$('#ajax').html(o);
				
			}
		});
		
	});

</script>