<?php

session_name('wmd');session_start();
require('../include/connect.php');


$empty = true;

if(!empty($_POST)){
	
	$empty = null;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	if(strlen($post['object'])< 3 || strlen($post['object'])> 64){
	
		$error['object'] = '<p class="error">Ce champ doit contenir entre 3 et 64 caractères</p>'; 
	}
	
	if(strlen($post['message'])< 20 || strlen($post['message'])>250){
	
		$error['message'] = '<p class="error">Ce champ doit contenir entre 20 et 250 caractères</p>'; 
	}
	
	if(count($error) === 0){
		
		$insert = $bdd->prepare('INSERT INTO contact_advertiser(sender_id,receiver_id,object,message)VALUES(:sender_id,:receiver_id,:object,:message)');
		
		$insert->bindValue(':sender_id',$post['sender_id']);
		$insert->bindValue(':receiver_id',$post['receiver_id']);
		$insert->bindValue(':object',$post['object']);
		$insert->bindValue(':message',$post['message']);
		
		if($insert->execute()){
			$done ='<h4 id="sate" data-state="on">Votre message a bien été envoyé à l\'annonceur!</h4><p>Vous recevrez une réponse  dans la messagerie de votre espace Welcomed</p>';
		}
		
	}
	
}

?>

<!--Header-->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title w-100">Contacter l'annonceur</h4>
</div>
<!--Body-->
<div class="modal-body" id="modal-contact-content">
<!--                            <div class="md-form">-->
		<input type="hidden" id="sender_id" name="sender_id" class="form-control" value="<?= $_SESSION['user']['id'] ?>">
		<input type="hidden" id="receiver_id" name="receiver_id" class="form-control" value="<?= $post['receiver_id'] ?>">
<!--                            <label for="name">Nom</label>-->
<!--                            </div>-->

	<div class="md-form"><input type="text" name="object" id="object" class="form-control" 
			<?php 	if(isset($empty)){

				echo '><label for="object">Objet du message</label>';

				}
				else{

					if(!isset($error['object'])){
						echo'value="'.$post['object'].'" disabled><label for="object" class="active">Objet du message</label>';
					}
					else{
						echo '><label for="object">Objet du message</label>'. $error['object'];
					}
				} ?>
	
		</div>
		
		<div class="md-form">
			<textarea name="message" id="message" cols="30" rows="10" class="form-control"><?php if(isset($empty)){echo '</textarea>';}else{if(!isset($error['message'])){echo $post['message'];}} ?></textarea>
<!--			<label for="message">Contenu du message</label>-->
			<?php if(isset($error['message'])){echo $error['message'];} ?>
		</div>



	<div class="text-center">
		
		<?php if(isset($done)){echo $done;}else{ if(isset($_SESSION['user'])){ echo '<span id="state" data-state="off"></span>';} echo '<button class="btn btn-lg btn-rounded btn-primary" data-url="contact_advertiser.php" id="contact_advertiser">Envoyer</button>
				<div id="info"></div>';} ?>
		
	</div>
</div>
<!--Footer-->
<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
</div>


<script>
	
	var b = [];
	
	function notEmpty(a){
		b = a !== '';
		return b;
	}
	
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
	
	$('#contact_advertiser').on('click', function(e){
				
				e.preventDefault();
		
		var min = [ $('#object').val(),$('#message').val(),$('#sender_id').val(), $('#receiver_id').val()].every(notEmpty);
		
		if(min === false){
		
			$('#info').html('<p class="error">Vous devez remplir les champs obligatoires(*)</p>');
		}
		else{
			
			url = 'modal/'+this.id+'.php';
					
					$.ajax({
						  type: 'post',
						  url: url,
						  data: { 
							  sender_id		: $('#sender_id').val(),
							  receiver_id	: $('#receiver_id').val(),
							  object		: $('#object').val(),
							  message		: $('#message').val(),

						  }

					}).done(function(o){
						//console.log(o);
						$('#ajax').html(o);

					});
				}
				
			});
	
</script>
