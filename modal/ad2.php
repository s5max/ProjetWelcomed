<?php

session_name('wmd');session_start();

?>


<!--Header-->
<div class="modal-header">
	<button type="button" class="close destroy" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title w-100">Choisissez votre formule de publication (2/3)</h4>
</div>
<!--Body-->
<div class="modal-body">
	
	
	<div class="formule">
		<h5>Formule Premium</h5>
		<p>En ligne 90 jours, classée en tête de liste (... jours après l'activation). En première page durant 30 jours.Le libellé est limité à 1500 caractères. Un diaporama de 6 photos accompagnent l'annonce</p>
		<a class="btn btn-lg btn-rounded btn-primary mod" data-url="" data-info="3" disabled>Acheter pour 90€ *</a>
		
	</div>
	<p class="note pad-right">* Bientôt disponible</p>
	
	<div class="formule">
		<h5>Formule Welcome</h5>
		<p>Annonce en ligne 30 jours, en première page 7 jours maximum. Le libellé est limité à 1000 caractères. Un diaporama de 6 photos accompagnent l'annonce.</p>
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
	<button type="button" class="btn btn-rounded btn-default destroy" data-dismiss="modal">Fermer </button>
</div>
	
	


<script>
	
	$('.mod').on('click', function(e){
		
		e.preventDefault();
		
		url = 'modal/'+this.getAttribute('data-url');
		option = this.getAttribute('data-info');
		
		$.ajax({
			type	: 'post',
			url		: url,
			data:{ option	: option },
			success:function(o){
				
				$('#ajax').html(o);
				
			}
		});
		
	});
	
	$('.destroy').on('click', function(e){
		
		url = 'ajax/destroy_post.php';
		
		$.ajax({
			type	: 'post',
			url		: url
		});
		
	});

</script>