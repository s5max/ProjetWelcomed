	<?php

session_name('wmd');
session_start();

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
	<div class="modal-body" id="modal-logout-content">

		<div class="text-center">
			<p>Vous êtes maintenant Déconnecté(e)</p>
<!--
			<button id="logout_yes" class="btn btn-lg btn-rounded btn-primary">Se Deconnecter</button>
			<button class="btn btn-lg btn-rounded btn-primary" data-dismiss="modal">Rester Connecter</button>
-->


		</div>
	</div>
	<!--Footer-->
	<div class="modal-footer">
		<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
	</div>
<script>

	$.ajax({type:'post',url:'refresh/navbar.php'}).done(function(o){$('#navrefresh').html(o);});
	$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});

</script>	