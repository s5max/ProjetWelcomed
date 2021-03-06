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
	
	
	if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
            $error[] = '<p class="error">L\'adresse email n\'est pas dans un format valide';
        }
        
	if(count($error) === 0){

		$select = $bdd->prepare('SELECT * FROM user WHERE email = :email LIMIT 1');

		$select->bindValue(':email',$post['email']);

		if($select->execute()){

			$user = $select->fetch(PDO::FETCH_ASSOC);

			if(password_verify($post['password'],$user['password'])){
				unset($user['password']);
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['firstname'] = $user['firstname'];
				$_SESSION['user']['lastname'] = $user['lastname'];
				$_SESSION['user']['email'] = $user['email'];
				$_SESSION['user']['wm_role'] = $user['wm_role']	
				
				$done = '<h4 id="state" data-state="on">Vous êtes maintenant connecté à votre compte!</h4><button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Reprendre là où j\'en étais</button>';

				//                    echo '<p>Vous êtes maintenant connecté à votre compte!</p><button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Reprendre là où j\'en étais</button>
				//					<script>$(\'#no-log\').css(\'display\',\'none\');$(\'#contact\').removeAttr(\'disabled\');</script>';

			}
			else{

				$error[] = '<p class="error">Votre identifiant et/ou votre mot de passe sont incorrectes</p>';

			}

		}else{

				$error[] = '<p class="error">Votre identifiant et/ou votre mot de passe sont incorrectes</p>';

		}

	}
	
}
	



?>
          
	<!--Header-->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title w-100" >Se Connecter</h4>
	</div>
	<!--Body-->
	<div class="modal-body">

		<form method="post" enctype="multipart/form-data">
			
			<p class="note">* Champs obligatoires</p>
			
			<?php if(isset($error)){echo implode($error,'<br>');} ?>
			
			<div class="md-form">
				<input type="text" id="email" name="email" class="form-control">
				<label for="email">Email *</label>
			</div>

			<div class="md-form">
				<input type="password" id="password" name="password" class="form-control">
				<label for="password">Mot de passe *</label>
			</div>
			
		
		</form>

			<div class="text-center">
				
				<?php if(isset($done)){echo $done;}else{echo '<button class="btn btn-lg btn-rounded btn-primary" id="login">Connexion</button>
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

	$('#login').on('click', function(e){

		e.preventDefault();
		
		var min = [$('#email').val(), $('#password').val()].every(notEmpty);
		
		if(min === false){
		
			$('#info').html('<p class="error">Vous devez remplir les champs obligatoires(*)</p>');
		}
		else{
			
			url = 'modal/'+this.id+'.php';
			
			$.ajax({
				  type: 'post',
				  url: url,
				  data: { 

					  email			: $('#email').val(),
					  password		: $('#password').val(),

				  }

			}).done(function(o){
				
				$('#ajax').html(o);
				if($('#state').data('state') === 'on'){
					$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});
				}

			});

		}

	});


</script>                                                  