<?php

session_name('wmd');session_start();
require('../include/connect.php');


$empty = true;

if(!empty($_POST)){
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	if(isset($post['object'])){
		
		$empty = null;
		
		if(strlen($post['object'])< 3 || strlen($post['object'])> 64){

			$error['object'] = '<p class="error">Ce champ doit contenir entre 3 et 64 caractères</p>'; 
		}

		if(strlen($post['message'])< 20 || strlen($post['message'])>250){

			$error['message'] = '<p class="error">Ce champ doit contenir entre 20 et 250 caractères</p>'; 
		}
		
	$maxSize = (1024 * 1000) * 2; 


	// Répertoire d'upload - ou seront téléchargés les photos

	$uploadDir = '../uploads/cv';

	//Type d'images acceptées en téléchargement
	$mimeTypeAvailable = ['application/msword', 'application/pdf'];

		//Traitement de la photo de la recette
	if(isset($_FILES['cv']) && $_FILES['cv']['error'] === 0){

		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['cv']['tmp_name'], FILEINFO_MIME_TYPE);

		$extension = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION);

		if(in_array($mimeType, $mimeTypeAvailable)){

			if($_FILES['cv']['size'] <= $maxSize){

				if(!is_dir($uploadDir)){
					mkdir($uploadDir, 0755);
				}

				$newCvName = uniqid('cv_').'.'.$extension;
				
				
				if(!move_uploaded_file($_FILES['cv']['tmp_name'], $uploadDir.$newCvName)){
					$error['cv'] = '<p class="error">Erreur lors de l\'upload de la photo</p>';
				}else{
					$cv = 'ok';
				}
			}
			else {
				$error['cv'] = '<p class="error">La taille du fichier excède 2 Mo</p>';
			}

		}
		else {
			$error['cv'] = '<p class="error">Le fichier n\'est pas une image valide</p>';
		}
	}
	

		if(count($error) === 0){
			
			if(isset($cv) && $cv == 'ok'){
				$insert = $bdd->prepare('INSERT INTO ad_message(sender_id,receiver_id,object,message,cv)VALUES(:sender_id,:receiver_id,:object,:message,:cv)');
				$insert->bindValue(':cv',$uploadDir.$newCvName);

			}else{
			
			$insert = $bdd->prepare('INSERT INTO ad_message(sender_id,receiver_id,object,message)VALUES(:sender_id,:receiver_id,:object,:message)');
			}
			
			$insert->bindValue(':sender_id',$post['sender_id']);
			$insert->bindValue(':receiver_id',$post['receiver_id']);
			$insert->bindValue(':object',$post['object']);
			$insert->bindValue(':message',$post['message']);

			if($insert->execute()){
				$done ='<h4 id="sate" data-state="on">Votre message a bien été envoyé à l\'annonceur!</h4><p>Vous recevrez une réponse  dans la messagerie de votre espace Welcomed</p>';
			}

		}
	}
	$_SESSION['user']['ad'] = $post['receiver'];

?>
	<input type="hidden" id="sender_id" name="sender_id" class="form-control" value="<?= $_SESSION['user']['id'] ?>">
		<input type="hidden" id="receiver_id" name="receiver_id" class="form-control" value="<?= $post['receiver'] ?>">

<?php	
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
		<input type="hidden" id="receiver_id" name="receiver_id" class="form-control" value="<?= $_SESSION['user']['ad'] ?>">
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
		
		<p class="lbl">Vous pouvez ajouter un cv à votre message</p>
		<input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 
            <input type="file" name="cv">
            <?php if(isset($error['cv'])){ echo $error['cv'];} ?>

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

