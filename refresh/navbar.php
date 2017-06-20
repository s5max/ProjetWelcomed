<?php 
session_name('wmd'); session_start();

//$m = '/Home/ProjetWelcomed/modal/';
$m = '/git/ProjetWelcomed/modal/';

?>
<li>
    <?php if(!isset($_SESSION['user'])){?>
        <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>
        
        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
    <?php }else{?>                                      
            
        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>ad1.php" data-toggle="modal" data-target="#modal4all">Publier une annonce</a>
        
        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>logout.php" data-toggle="modal" data-target="#modal4all">Se déconnecter</a>
        
        
    <?php }?>
</li>


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