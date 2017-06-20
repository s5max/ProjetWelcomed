<?php 

session_name('wmd');session_start();
require('../include/connect.php');

$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$profession = $select->fetchAll(PDO::FETCH_ASSOC);

	}

$empty = true;

if(!empty($_POST)){
	
	$empty = null;
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	if(!empty($post['profession'])){
		if(!is_numeric($post['profession'])){

			$error['profession'] = '<p class="error">Seuls les propositions de la liste sont acceptées</p>';
		}
	}
	
	if(strlen($post['firstname']) < 3 || strlen($post['firstname']) > 64){
		$error['firstname'] = '<p class="error">oulala,</p>';
		
	}
	
	if(strlen($post['lastname']) < 3 || strlen($post['lastname']) > 255){
		$error['lastname'] = '<p class="error">oulala,</p>';
	}
	
	if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
		$error['email'] = '<p class="error">oulala,</p>';
	}
	else{
		
		$select = $bdd->prepare('SELECT email from user WHERE email = :email');

		$select->bindValue(':email',$post['email']);
		
		$select->execute();
		$email = $select->fetch(PDO::FETCH_ASSOC);

		if($email['email']){
			$error['email'] = '<p class="error">oulala,</p>';
		}
	}
	
	if(strlen($post['password']) < 6){
            
			$error['password'] = '<p class="error">popopop,</p>';
        }
        else{
            
            //Crypté le mot de passe
            $password = password_hash($post['password'], PASSWORD_DEFAULT);
            
        }
	

	if(count($error) === 0){
	
	
	if(!empty($post['profession'])){
		
		$insert = $bdd->prepare('INSERT INTO user(profession_id,firstname,lastname,email,password,wm_role)VALUES(:profession_id,:firstname,:lastname,:email,:password,:wm_role)');
		
			$insert->bindValue(':profession_id',$post['profession']);
//			$insert->bindValue(':profession',$post['name']);
	}
	else{
		
		$insert = $bdd->prepare('INSERT INTO user(firstname,lastname,email,password,wm_role)VALUES(:firstname,:lastname,:email,:password,:wm_role)');
		
	}
	
	$insert->bindValue(':firstname',$post['firstname']);
	$insert->bindValue(':lastname',$post['lastname']);
	$insert->bindValue(':email',$post['email']);
	$insert->bindValue(':password',$password);
	$insert->bindValue(':wm_role','user');

	if($insert->execute()){

		$done = '<div class="done"><h4>Bienvenue dans la communauté Welcomed !!!</h4><a class="btn btn-lg btn-rounded btn-primary mod" data-url="login.php" >Se connecter</a></div>';
		//$done = '<div class="done"><h4>Bienvenue dans la communauté Welcomed !!!</h4><button class="btn btn-lg btn-rounded btn-primary" title="login.php" id="subscribe">S\'inscrire</button>';
		
	}else{
		var_dump($insert->errorInfo());
	}
	
}
	
}


?>
          
	<!--Header-->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title w-100" >Formulaire d'inscription</h4>
	</div>
	<!--Body-->
	<div class="modal-body">

		<form method="post" enctype="multipart/form-data">
			
			<select name="profession" id="profession" class="form-control">
			<?php if(isset($empty)){ ?>
				<option value="0">--- Choisir votre profession ---</option>
				<?php foreach($profession as $value){ echo '<option value="'.$value['id'].'">'.$value['speciality'].'</option>';} ?>
			<?php }else{ echo '<option value="'.$post['profession'].'" selected >'.$post['profession_name'].'</option>';} ?>
		</select>

			<p class="note">* Champs obligatoires</p>

			<div class="md-form"><input type="text" name="firstname" id="firstname" class="form-control" <?php if(isset($empty)){echo '><label for="firstname">Votre Nom *</label>'; }else{if(!isset($error['firstname'])){echo'value="'.$post['firstname'].'" disabled><label for="firstname" class="active">Votre Nom *</label>';}else{echo '><label for="firstname">Votre Nom *</label>'. $error['firstname'];}} ?></div>
			
			
			<div class="md-form"><input type="text" name="lastname" id="lastname" class="form-control" 
			<?php 	if(isset($empty)){
	
					echo '><label for="lastname">Votre Prénom *</label>';
	
					}
					else{
						
						if(!isset($error['lastname'])){
							echo'value="'.$post['lastname'].'" disabled><label for="lastname" class="active">Votre Nom *</label>';
						}
						else{
							echo '><label for="lastname">Votre Prénom *</label>'. $error['lastname'];
						}
					} ?>
			</div>
			
			
			<div class="md-form"><input type="text" name="email" id="email" class="form-control" 
			<?php 	if(isset($empty)){
	
					echo '><label for="email">Votre Email *</label>';
	
					}
					else{
						
						if(!isset($error['email'])){
							echo'value="'.$post['email'].'" disabled><label for="email" class="active">Votre Nom *</label>';
						}
						else{
							echo '><label for="email">Votre Email *</label>'. $error['email'];
						}
					} ?>
			</div>
			
			
			<div class="md-form"><input type="password" name="password" id="password" class="form-control" 
			<?php 	if(isset($empty)){
	
					echo '><label for="password">Votre Mot de Passe *</label>';
	
					}
					else{
						
						if(!isset($error['password'])){
							echo'value="'.$post['password'].'" disabled><label for="password" class="active">Votre Mot de Passe *</label>';
						}
						else{
							echo '><label for="password">Votre Mot de passe *</label>'. $error['password'];
						}
					} ?>
			</div>
		
		</form>

			<div class="text-center">
				
				<?php if(isset($done)){echo $done;}else{echo '<button class="btn btn-lg btn-rounded btn-primary" data-url="subscribe.php" id="subscribe">S\'inscrire</button>
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
	

	$('#subscribe').on('click', function(e){

		e.preventDefault();
		
		var min = [ $('#firstname').val(),$('#lastname').val(),$('#email').val(), $('#password').val()].every(notEmpty);
		
		if(min === false){
		
			$('#info').html('<p class="error">Vous devez remplir les champs obligatoires(*)</p>');
		}
		else{
			
			url = 'modal/'+this.id+'.php';
			
			$.ajax({
				  type: 'post',
				  url: url,
				  data: { 

					  profession    : $('#profession').val(),
					  profession_name: $('#profession option:selected').text(),
					  firstname		: $('#firstname').val(),
					  lastname		: $('#lastname').val(),
					  email			: $('#email').val(),
					  password		: $('#password').val(),

				  }

			}).done(function(o){
				
				$('#ajax').html(o);


			});

		}

	});


</script>                                                  