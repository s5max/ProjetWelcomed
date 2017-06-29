<?php

session_name('wmd');session_start();
require('../include/connect.php');

$empty = true;

if(!empty($_POST)){
	
if(isset($_POST['option'])){
	$post = array_map('trim',array_map('strip_tags',$_POST));$_SESSION['post']['option'] = $post['option'];
}
else{

	$empty = null;
	$place = 0;
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
var_dump($post);	
	if($_SESSION['post']['info']['type'] === '1' || $_SESSION['post']['info']['type'] === '2' || $_SESSION['post']['info']['type'] === '3'){
	
		if(!empty($post['office'])){ $place++;}
		if(!empty($post['homes'])){ $place++;}
	
		if(isset($post['office'])){
			if($post['office'] !== 'on' || $post['office'] !== 'off')
				$error['office'] = '<p class="error">Paramètre invalide</p>';
		}else{
			$_SESSION['post']['detail']['office'] = $post['office'];
		}

		if(isset($post['homes']) || $post['homes'] !== 'on' && $post['homes'] !== 'off'){
			$error['homes'] = '<p class="error">Paramètre invalide</p>';
		}else{
			$_SESSION['post']['detail']['home'] = $post['homes'];
		}
		
		if($post['homes'] == 'off' && $post['office'] == 'off'){
			$error['homes'] = '<p class="error">Il faut préciser au moins un lieu</p>';
		}
		
	}
	
	if($_SESSION['post']['info']['type'] === '1' || $_SESSION['post']['info']['type'] === '3'){
	
		if(!isset($_SESSION['post']['detail']['retrocession'])){
			if(!is_numeric($post['retrocession'])){

				$error['retrocession'] = '<p class="error">L\'information doit être un chiffre</p>';
			}else{

			$_SESSION['post']['detail']['retrocession']=$post['retrocession'];
			}
		}
	}else if($_SESSION['post']['info']['type'] === '4'){
		
		if(!isset($_SESSION['post']['detail']['company'])){
		if(strlen($post['company']) < 5 || strlen($post['company']) > 40){

			$error['company'] = '<p class="error">Le nombre de caractères du titre doit être compris entre 5 et 40</p>';
		}else{

			$_SESSION['post']['detail']['company']=$post['company'];
		}
	}
	}
	
	if(!isset($_SESSION['post']['detail']['title'])){
		if(strlen($post['title']) < 5 || strlen($post['title']) > 40){

			$error['title'] = '<p class="error">Le nombre de caractères du titre doit être compris entre 5 et 40</p>';
		}else{

			$_SESSION['post']['detail']['title']=$post['title'];
		}
	}
	
	if(strlen($post['content']) < 5 || strlen($post['content']) > 200){

		$error['content'] = '<p class="error">Souscrivez à l\'offre Premium pour écrire un texte plus grand</p>';
	}else{
		
		$_SESSION['post']['detail']['content']=$post['content'];
	}
	
	
if($_SESSION['post']['option'] !== '1'){
	// Taille maximum du fichier photo de la recette
$maxSize = (1024 * 1000) * 2; 


// Répertoire d'upload - ou seront téléchargés les photos

$uploadDir = '../uploads/';

//Type d'images acceptées en téléchargement
$mimeTypeAvailable = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];

	
//Traitement de la photo de la recette
	if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0){

		$finfo = new finfo();
		$mimeType = $finfo->file($_FILES['picture']['tmp_name'], FILEINFO_MIME_TYPE);

		$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

		if(in_array($mimeType, $mimeTypeAvailable)){

			if($_FILES['picture']['size'] <= $maxSize){

				if(!is_dir($uploadDir)){
					mkdir($uploadDir, 0755);
				}

				$newPictureName = uniqid('picture_').'.'.$extension;
				
				
				if(!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadDir.$newPictureName)){
					$error['picture'] = '<p class="error">Erreur lors de l\'upload de la photo</p>';
				}
			}
			else {
				$error['picture'] = '<p class="error">La taille du fichier excède 2 Mo</p>';
			}

		}
		else {
			$error['picture'] = '<p class="error">Le fichier n\'est pas une image valide</p>';
		}
	}
	else {
		$error['picture'] = '<p class="error">Aucune photo sélectionnée</p>';
	}
}
	if(count($error) === 0){
			
//		foreach($post as $k => $v){
//			$_SESSION['post']['detail'][$k] = $v;
//		}
			
			$insert = $bdd->prepare('INSERT INTO ad(option_id,user_id,profession_id,offer_id,city_id,detail)VALUES(:option_id,:user_id,:profession_id,:offer_id,:city_id,:detail)');

			$insert->bindValue(':option_id',$_SESSION['post']['option']);
			$insert->bindValue(':user_id',$_SESSION['post']['info']['user_id']);
			$insert->bindValue(':profession_id',$_SESSION['post']['info']['profession']);
			$insert->bindValue(':offer_id',$_SESSION['post']['info']['type']);
			$insert->bindValue(':city_id',$_SESSION['post']['info']['city']);
			
			$insert->bindValue(':detail',json_encode($_SESSION['post']['detail']));
			

			if($insert->execute()){

				$done = '<p>Votre annonce a été enregistrée. Vous pourrez recevoir des messages de personnes interessées dans la messagerie de votre espace personel welcomed</p>';
				
			}else{var_dump($insert->errorInfo());}	
		
	
		}
	}
	
}

?>


<!--Header-->
<div class="modal-header">
	<button type="button" class="close destroy" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title w-100">Publier une annonce : Etape 3/3</h4>
</div>


<!--Body-->
<div class="modal-body">

	<form id="ad3" method="post" enctype="multipart/form-data">

		<div class="md-form"><input type="text" name="title" id="title" class="form-control" 
			<?php 	if(isset($empty)){

				echo '><label for="title">Titre de l\'annonce *</label>';

				}
				else{

					if(!isset($error['title'])){
						if(isset($post['title'])){
							echo'value="'.$post['title'].'" disabled><label for="title" class="active">Titre de l\'annonce *</label>';
						}else{
							echo'value="'.$_SESSION['post']['detail']['title'].'" disabled><label for="title" class="active">Titre de l\'annonce *</label>';
						}
					}
					else{
						echo '><label for="title">Titre de l\'annonce *</label>'. $error['title'];
					}
				} ?>
	
		</div>

		
		<?php	if($_SESSION['post']['info']['type'] === '1' || $_SESSION['post']['info']['type'] === '2' || $_SESSION['post']['info']['type'] === '3'){ ?>
		
			<p class="lbl">Lieu de consultation *</p>
			<div class="option">
				<span data-id="office" 
				<?php if(isset($post['office']) && $post['office'] == 'on'){ echo 'class="chosen"'; }
					if(!empty($_SESSION['post']['detail']['office']) && $_SESSION['post']['detail']['office'] == 'on'){ echo 'class="chosen"'; }?>
				>Cabinet</span>
				
				<span data-id="homes"<?php if(isset($post['homes']) && $post['homes'] == 'on'){ echo 'class="chosen"'; }
					if(!empty($_SESSION['post']['detail']['homes']) && $_SESSION['post']['detail']['homes'] == 'on'){ echo 'class="chosen"'; }?>
				>Domicile(patient)</span>
					
				<input type="hidden" name="office" id="office" <?php if(isset($post['office']) && $post['office'] == 'on'){ echo 'value="on"'; }
					if(!empty($_SESSION['post']['detail']['office']) && $_SESSION['post']['detail']['office'] == 'on'){ echo 'value="on"'; }else{ echo 'value="off"';}?>
				>
				
				<input type="hidden" name="homes" id="homes" <?php if(isset($post['homes']) && $post['homes'] == 'on'){ echo 'value="on"'; }
					if(!empty($_SESSION['post']['detail']['homes']) && $_SESSION['post']['detail']['homes'] == 'on'){ echo 'value="on"'; }else{ echo 'value="off"';}?>
				>
				
				
			</div>

			<?php if(isset($place) && $place === 0 || isset($error['homes'])){ echo '<p class="error">Mais où, alors?</p>'; } ?>
		
		<?php } ?>
		
		
		<?php 	if($_SESSION['post']['info']['type'] === '1' || $_SESSION['post']['info']['type'] === '3'){ ?>
		

		<div class="md-form"><input type="number" name="retrocession" id="retrocession" class="form-control" 
		<?php 	if(isset($empty)){

				echo '><label for="retrocession">Rétrocession *</label>';

				}
				else{

					if(!isset($error['retrocession'])){
						if(isset($post['retrocession'])){
							echo'value="'.$post['retrocession'].'" disabled><label for="retrocession" class="active">Rétrocession *</label>';
						}else{
							echo'value="'.$_SESSION['post']['detail']['retrocession'].'" disabled><label for="retrocession" class="active">Rétrocession *</label>';
						}
					}
					else{
						echo '><label for="retrocession">Rétrocession *</label>'. $error['retrocession'];
					}
				} ?>
		</div>
		
		<?php 	}else if($_SESSION['post']['info']['type'] === '4'){ ?>
		
			<div class="md-form">
			<select name="contract" id="contract" class="form-control">
				<?php if(isset($empty) || isset($error['contract'])){ ?>
				<option value="0" selected disabled>--- Type de Contrat * ---</option>
				<option value="CDD">CDD</option>
				<option value="CDI">CDI</option>
				<!--<option value="Remplacement">Remplacement</option>-->
				<option value="Autre">Autre</option>
				<?php }else{ echo '<option value="'.$post['contract'].'" selected>'.$post['contract'].'</option>';} ?>
			</select>
		</div>
		
		<!--	 non obligatoire-->
		<div class="md-form">
			<select name="daytime" id="daytime" class="form-control">
				<?php if(isset($empty) || isset($error['daytime'])){ ?>
				<option value="0" selected disabled>--- Type de journée * ---</option>
				<option value="Mi-Temps">Mi-temps</option>
				<option value="Temps-Plein">Temps plein</option>
				<option value="Vacation">Vacation</option>
				<?php }else{ echo '<option value="'.$post['daytime'].'" selected>'.$post['daytime'].'</option>';} ?>
			</select>
		</div>
		
		
		<div class="md-form"><input type="text" name="company" id="company" class="form-control" 
			<?php 	if(isset($empty)){

				echo '><label for="company">Entreprise *</label>';

				}
				else{

					if(!isset($error['company'])){
						if(isset($post['company'])){
							echo'value="'.$post['company'].'" disabled><label for="company" class="active">Entreprise *</label>';
						}else{
							echo'value="'.$_SESSION['post']['detail']['company'].'" disabled><label for="company" class="active">Entreprise *</label>';
						}
					}
					else{
						echo '><label for="company">Entreprise *</label>'. $error['company'];
					}
				} ?>
		</div>
		
		<?php 	} ?>

		<div class="md-form">
			<textarea name="content" id="content" cols="30" class="rounded"><?php if(isset($empty)){echo '</textarea>';}else{if(!isset($error['content'])){echo $post['content'];}} ?></textarea>
			<label for="content" class="active">Contenu de l'annonce</label>
			<?php if(isset($error['content'])){echo $error['content'];} ?>
		</div>
<!--	Vous pouvez booster votre annonce avec des photos en souscrivant à l'une de nos offres (a afficher pour pour option de base)	-->
		<div class="btn btn-rounded btn-primary">
		<p class="lbl">Vous pouvez ajouter 6 images</p> 
		<?php if($_SESSION['post']['option'] === '1'){ echo '<a class="mod lien destroy_ad3" data-url="ad2.php" data-info="1">en souscrivant à l\'une de nos offres</a>';} ?>
		
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 
            <input type="file" name="picture"<?php if($_SESSION['post']['option'] === '1'){ echo 'disabled';} ?>>
            <?php if(isset($error['picture'])){ echo $error['picture'];} ?>
		</div>   
		<div class="text-center">

			<?php if(isset($done)){echo $done;}else{echo '<input type="submit" class="btn btn-lg btn-rounded btn-primary" value="Soumettre l\'annonce"><div id="info"></div>';} ?>

		</div>

	</form>

</div>

<!--Footer-->
<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-default destroy" data-dismiss="modal">Fermer *</button>
</div>
	<p class="note pad-right">* Les informations ne seront pas enregistrées si vous fermez la page</p>
	


<script>
	
	var b = [];
	
	function notEmpty(a){
		b = a !== null;
		return b;
	}
	
	var reference = {};
	$('.option>span').click(function(e){
        
		idSpan = $(this).data('id');
		att = $(this).attr('class');
		
		if(idSpan == 'office'){
			span = $('#office');
		}else{
			span = $('#homes');
		}
		
		if(att === undefined){
			$(this).attr('class','chosen');
			span.val('on');
		}else{
			$(this).removeAttr('class');
			span.val('off');
		}
		
		//console.log($().val());
	});
	
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
	
	
	$('#ad3').on('submit', function(e) {

		e.preventDefault();
		
		<?php if($_SESSION['post']['info']['type'] === '4'){ echo'
														   
		var min = [$(\'#contract\').val(),$(\'#daytime\').val() ].every(notEmpty);
		
		if(min === false){
		
			$(\'#info\').html(\'<p class="error">Vous devez remplir les champs obligatoires(*)</p>\');
		}
		else{';
		} ?>
			
			var $form = $(this);
        	var formdata = (window.FormData) ? new FormData($form[0]) : null;
        	var data = (formdata !== null) ? formdata : $form.serialize();
		
			url = 'modal/'+this.id+'.php';
			
			$.ajax({
				  type: 'post',
				  url: url,
				  contentType: false, // obligatoire pour de l'upload
          		  processData: false, // obligatoire pour de l'upload	
				  data : data
				  
			}).done(function(o){
				
				$('#ajax').html(o);

			});
		
		<?php if($_SESSION['post']['info']['type'] === '4'){ echo'}';} ?>
	});
	
	
	
	
	$('.destroy').on('click', function(e){
		
		url = 'ajax/destroy_post.php';
		
		$.ajax({
			type	: 'post',
			url		: url
		});
		
	});
	
	
	$('.destroy_ad3').on('click', function(e){
		
		url = 'ajax/destroy_post_ad3.php';
		
		$.ajax({
			type	: 'post',
			url		: url
		});
		
	});


</script>