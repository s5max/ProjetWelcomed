<?php 

session_name('wmd');session_start();
require('../include/connect.php');

$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$profession = $select->fetchAll(PDO::FETCH_ASSOC);

	}
	
	$select = $bdd->prepare('SELECT * FROM offer');

	if($select->execute()){

		$offerList = $select->fetchAll(PDO::FETCH_ASSOC);

		$offer = [];
		$demand = [];
		foreach($offerList as $value){
			if($value['id']<5){
				$offer[] = [$value['id'],$value['type']];
			}
			elseif($value['id']>4){
				$demand[] = [$value['id'],$value['type']];
			}
		}
		
	}

	$select = $bdd->prepare('SELECT * FROM city');

	if($select->execute()){

		$city = $select->fetchAll(PDO::FETCH_ASSOC);

	}

$empty = true;

if(!empty($_POST)){
	
	$empty = null;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
		if(!is_numeric($post['type'])){
            
            $error['type'] = '<p class="error" Seuls les propositions de la liste sont acceptées</p>';
        }
        
        
        if(!is_numeric($post['profession'])){
            
            $error['profession'] = '<p class="error" Seuls les professions de la liste sont acceptées</p>';
        }
        
        //Département
        if($post['department'] != 'Martinique'){
            
            $error['department'] = '<p class="error" Les offres concernent uniquement la Martinique</p>';
        }
        
        //Ville
        if(!is_numeric($post['city'])){
            
            $error['city'] = '<p class="error" Seuls les villes de la liste sont acceptées</p>';
        }
        
	
	//Date début et fin
        if(!empty($post['date_end'])){
		if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#',$post['date_start'])){
            
            $error['date_start'] = '<p class="error">La date doit être écrite comme dans l\'exemple suivant : 01/03/2017</p>';
            
        }
		}
	
		if(!empty($post['date_end'])){
			if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#',$post['date_end'])){

				$error['date_end'] = '<p class="error">La date doit être écrite comme dans l\'exemple suivant : 01/03/2017</p>';

			}
		}
	
	
		if(count($error) === 0){
			
			$_SESSION['post']['info']['user_id'] = $_SESSION['user']['id'];
			$_SESSION['post']['info']['type'] = $post['type'];
			$_SESSION['post']['info']['profession'] = $post['profession'];
			$_SESSION['post']['info']['city'] = $post['city'];
			
			$_SESSION['post']['detail']['department'] = $post['department'];
			
			if(!empty($post['date_end'])){$_SESSION['post']['detail']['date_start'] = $post['date_start'];}
			if(!empty($post['date_end'])){$_SESSION['post']['detail']['date_end'] = $post['date_end'];}
			
			$done = '<div id="allow" data-state="on"></div>';
			
		}
	
	
}
	
?>
<!--Header-->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title w-100">Publier une annonce : Etape 1/3</h4>
</div>
<!--Body-->
<div class="modal-body">

	<form method="post" enctype="multipart/form-data">
		
		<p class="note">* Champs obligatoires</p>
		
		<select name="type" id="type" class="form-control">
			
			<?php if(isset($empty)){ ?>
			<option value="false" selected disabled>-- Type d'annonce * --</option>
							
			<optgroup label="Offre">
			<?php foreach($offer as $value){
					echo'<option value="'.$value[0].'">'.$value[1].'</option>';
				}//End foreach ?>
			<optgroup label="Demande">
			<?php foreach($demand as $value){
					echo'<option value="'.$value[0].'">'.$value[1].'</option>';
			}//End foreach ?>
			<?php }else{ echo '<option value="'.$post['type'].'" selected>'.$post['type_name'].'</option>';} ?>
		</select>

		<select name="profession" id="profession" class="form-control">
			<?php if(isset($empty)){ ?>
				<option value="none">--- Professionel(le) Recherché(e) * ---</option>
				<?php foreach($profession as $value){ echo '<option value="'.$value['id'].'">'.$value['speciality'].'</option>';} ?>
			<?php }else{ echo '<option value="'.$post['profession'].'" selected>'.$post['profession_name'].'</option>';} ?>
		</select>

		<div class="md-form">
			<input type="text" id="department" name="department" class="form-control" value="Martinique" disabled>
			<label for="department" class="active">Département</label>
		</div>

		<div class="md-form">
			<select name="city" id="city" class="form-control">
				<?php if(isset($empty)){ ?>
				<option value="none" selected disabled>-- Commune * --</option>
				<?php foreach ($city as $value): ?>
					<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
				<?php endforeach; ?>
				<?php }else{ echo '<option value="'.$post['city'].'" selected>'.$post['city_name'].'</option>';} ?>
			</select>
		</div>

		<div class="md-form"><input type="text" name="date_start" id="date_start" class="form-control" 
		<?php 	if(isset($empty)){

				echo '>';

				}
				else{

					if(!isset($error['date'])){
						echo'value="'.$post['date_start'].'" disabled>';
					}
					else{
						echo '>'. $error['date_start'];
					}
				} ?>
				
			<label for="date_start" class="active">Date de début   Ex: 01/07/2017</label>
		</div>

		<div class="md-form"><input type="text" name="date" id="date_end" placeholder="jj/mm/aaaa" class="form-control" 
		<?php 	if(isset($empty)){

				echo '>';

				}
				else{

					if(!isset($error['date_end'])){
						echo'value="'.$post['date_end'].'" disabled>';
					}
					else{
						echo '>'. $error['date_end'];
					}
				} ?>
				
			
			<label for="date_end" class="active">Date de fin </label>
		</div>

		<div class="text-center">

			<?php if(isset($done)){echo $done;}else{echo '<button class="btn btn-lg btn-rounded btn-primary" id="ad1">Etape Suivante</button>
				<div id="info"></div>';} ?>

		</div>

	</form>

</div>
<!--Footer-->
<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Fermer *</button>
</div>
	<p class="note pad-right">* Les informations ne seront pas enregistrées si vous fermez la page</p>




<script>
	
	var b = [];
	
	function notEmpty(a){
		b = a !== null;
		return b;
	}
	

	
	$('#ad1').on('click', function(e){

		e.preventDefault();
		
		var min = [$('#type').val(),$('#profession').val(), $('#department').val(),$('#city').val(), ].every(notEmpty);
		
		if(min === false){
		
			$('#info').html('<p class="error">Vous devez remplir les champs obligatoires(*)</p>');
		}
		else{
			
			url = 'modal/'+this.id+'.php';
			
			$.ajax({
				  type: 'post',
				  url: url,
				  data: { 
					  type 				: $('#type').val(),
					  type_name			: $('#type option:selected').text(),
					  profession 		: $('#profession').val(),
					  profession_name 	: $('#profession option:selected').text(),
					  department 		: $('#department').val(),
					  city 				: $('#city').val(),
					  city_name			: $('#city option:selected').text(),
					  date_start		: $('#date_start').val(),
					  date_end			: $('#date_end').val(),

				  }

			}).done(function(o){
				
				$('#ajax').html(o);
				if($('#allow').data('state') === 'on'){
					$.ajax({type:'post',url:'modal/ad2.php'}).done(function(o){$('#ajax').html(o);});
				}

			});

		}

	});

</script>