<?php

session_name('wmd');session_start();

require('../include/route.php');

unset($_SESSION['user']);

session_destroy();

?>
	
	<!--Header-->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title w-100">Se Déconnecter</h4>
	</div>
	<!--Body-->
	<div class="modal-body">

		<div class="text-center">
		
			<p>Vous êtes maintenant Déconnecté(e)</p>

		</div>
	</div>
	<!--Footer-->
	<div class="modal-footer">
		<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
	</div>
<script>
	loc = 'http://localhost<?= $r ?>'+'account.php';
			
			p = window.location.href;
			
			if(p === loc){
				
				$.ajax({type:'post',url:'index.php'}).done(function(o){$('body').html(o);});
			}
	
	$.ajax({type:'post',url:'refresh/navbar.php'}).done(function(o){$('#navbarNav').html(o);});
	$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});

</script>	