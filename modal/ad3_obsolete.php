<?php

session_name('wmd');session_start();
require('../include/connect.php');
$empty = true;

?>

<!--Header-->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title w-100">Publier une annonce : Etape 2/3</h4>
</div>
<!--Body-->
<div class="modal-body">

<?php
	
if($_SESSION['post']['info']['type'] === '1' || $_SESSION['post']['info']['type'] === '3'){

if(!empty($_POST)){
	
	$empty = null;
	$place = 0;
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	if(!empty($post['office'])){ $place++;}
	if(!empty($post['home'])){ $place++;}
	
	
	
	if(isset($post['office']) && $post['office'] != 'on'){
			$error['office'] = '<p class="error">Paramètre invalide</p>';
	}

	if(isset($post['home']) && $post['home'] != 'on'){
		$error['home'] = '<p class="error">Paramètre invalide</p>';
	}
	
	if(!is_numeric($post['retrocession'])){

		$error['retrocession'] = '<p class="error">L\'information doit être un chiffre</p>';
	}
	
	
	if(count($error) === 0){
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
		$done = '<div id="allow4" data-state="on"></div>';
	
	}

}
?>

<!-- assistanat / remplacement -->
<form method="post" enctype="multipart/form-data">
	
	<p class="note">* Champs obligatoires</p>
	
	<p class="lbl">Lieu de consultation *</p>

	<div class="option">
		<span class="option2" data-id="office" data-info="on">Cabinet</span>
		<span class="option2" data-id="home" data-info="on">Domicile(patient)</span>
	</div>
	<?php if(isset($place) && $place === 0){ echo '<p class="error">Mais où, alors?</p>'; } ?>
	
	<div class="md-form"><input type="number" name="retrocession" id="retrocession" class="form-control" 
	<?php 	if(isset($empty)){

			echo '><label for="retrocession">Rétrocession *</label>';

			}
			else{

				if(!isset($error['retrocession'])){
					echo'value="'.$post['retrocession'].'" disabled><label for="retrocession" class="active">Rétrocession *</label>';
				}
				else{
					echo '><label for="retrocession">Rétrocession *</label>'. $error['retrocession'];
				}
			} ?>
	</div>
	
</form>

<?php	

}
else if($_SESSION['post']['info']['type'] === '2'){

	if(!empty($_POST)){

		$empty = null;
		$place = 0;
		$post = array_map('trim',array_map('strip_tags',$_POST));
		$error = [];
		
		if(!empty($post['office'])){ $place++;}
		if(!empty($post['home'])){ $place++;}
	
		
		if(isset($post['office']) && $post['office'] != 'on'){
			$error['office'] = 'Paramètre invalide';
		}
		
		if(isset($post['home']) && $post['home'] != 'on'){
			$error['home'] = 'Paramètre invalide';
		}
		
		
		if(count($error) === 0){
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
		$done = '<div id="allow4" data-state="on"></div>';
	
		}
		

	}
?>


<form method="post" enctype="multipart/form-data">
	
	<p class="note">* Champs obligatoires</p>
	
	<p class="lbl">Lieu de consultation *</p>

	<div class="option">
		<span class="option2" data-id="office" data-info="on">Cabinet</span>
		<span class="option2" data-id="home" data-info="on">Domicile(patient)</span>
	</div>
	<?php if(isset($place) && $place === 0){ echo '<p class="error">Mais où, alors?</p>'; } ?>
																			
	
	

</form>


<?php
	
}
else if($_SESSION['post']['info']['type'] === '4'){

	if(!empty($_POST)){
	
	$empty = null;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	var_dump($post);	
	
	
			
		$contractAllowed = ['CDD','CDI','Remplacement','Autre'];

		if(!in_array($post['contract'],$contractAllowed)){
			$error['contract'] = '<p class="error">Seuls les types de contrat de la liste sont acceptées</p>';
		}
		
		if(!empty($post['daytime'])){
			$ratioAllowed = ['Mi-Temps','Temps-Plein','Vacation'];

			if(!in_array($post['daytime'],$ratioAllowed)){
				$error['daytime'] = '<p class="error">Seuls les types de la liste sont acceptées</p>';
			}
		}
		
		if(strlen($post['company']) < 3 || strlen($post['company']) > 128){
			echo'vu';
			$error['company'] = '<p class="error">Le nom doit contenir entre 3 et 128 lettres</p>';
		}
		

		
		
		
		if(count($error) === 0){
			
			foreach($post as $k => $v){
				$_SESSION['post']['detail'][$k] = $v;
			}
		$done = '<div id="allow4" data-state="on"></div>';
	
		}
	}

?>	

	<form method="post" enctype="multipart/form-data">
		
		<p class="note">* Champs obligatoires</p>					
							
		
		<div class="md-form">
			<select name="contract" id="contract" class="form-control">
				<?php if(isset($empty) || isset($error['contract'])){ ?>
				<option value="0" selected disabled>--- Type de Contrat * ---</option>
				<option value="CDD">CDD</option>
				<option value="CDI">CDI</option>
<!--				<option value="Remplacement">Remplacement</option>-->
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
				<?php }else{ echo '<option value="'.$post['daytime'].'" selected>'.$post['daytime'].'</option>';} ?>
			</select>
		</div>
		
		
		<div class="md-form"><input type="text" name="company" id="company" class="form-control" 
			<?php 	if(isset($empty)){

				echo '><label for="company">Entreprise *</label>';

				}
				else{

					if(!isset($error['company'])){
						echo'value="'.$post['company'].'" disabled><label for="company" class="active">Entreprise *</label>';
					}
					else{
						echo '><label for="company">Entreprise *</label>'. $error['company'];
					}
				} ?>
		</div>


		




	</form>

<?php
	
}

?>

<?php
	
//}
//else if($_SESSION['post']['info']['type'] > '4'){
//

//}
?>

	<div class="text-center">

		<?php if(isset($done)){echo $done;}else{echo '<button class="btn btn-lg btn-rounded btn-primary" id="ad3">Etape Suivante</button><div id="info"></div>';} ?>

	</div>
</div>
<!--Footer-->
<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer *</button>
</div>
	<p class="note pad-right">* Les informations ne seront pas enregistrées si vous fermez la page</p>

<script>

	var reference = {};
	$('.option>span.option2').click(function(e){
        
        $(this).css('border','solid #757575 2px');
		$(this).css('color','#757575');
		
        
        var key     = $(this).data('id');
        var value   = $(this).data('info');
		
		reference[key] = value;
		
	});
	
	
	$('#ad3').on('click', function(e){
		
		e.preventDefault();
		
		
			
			url = 'modal/'+this.id+'.php';
			
			$.ajax({
				  type: 'post',
				  url: url,
				  data: {
					  
					home 		:reference['home'],
					office 		:reference['office'],
					retrocession:$('#retrocession').val(),
					sales		:$('#sales').val(),
					partner		:$('#partner').val(),
					contract	:$('#contract').val(),
					daytime		:$('#daytime').val(),
					company		:$('#company').val(),
				  }

			}).done(function(o){
				
				$('#ajax').html(o);
				if($('#allow4').data('state') === 'on'){
					$.ajax({type:'post',url:'modal/ad4.php'}).done(function(o){$('#ajax').html(o);});
				}

			});

	});
	
</script>