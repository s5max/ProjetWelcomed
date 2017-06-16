<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/tether.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap4.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<script>

	//Animation init
	new WOW().init();

	// Material Select Initialization
	$(document).ready(function() {
		$('.mdb-select').material_select();
	});

</script>

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
	
//	var b = [];
//	
//	function notEmpty(a){
//		b = a !== '';
//		return b;
//	}
	

</script>

<!--
<script>
	
	var b = [];
	
	function notEmpty(a){
		b = a !== '';
		return b;
	}

	$('#subscribe').on('click', function(e){

		e.preventDefault();
		
		var min = [ $('#firstname').val(),$('#lastname').val(),$('#email1').val(), $('#password').val()].every(notEmpty);
		
		if(min === false){

			$('#modal-content').append('<p class="error">Vous devez remplir les champs obligatoires(*)</p>');
		}
		else{
			
			url = $('#modal-subscribe').data('url');
			
			$.ajax({
				  type: 'post',
				  url: url,
				  data: { 

					  profession    : $('#profession1').val(),
					  name			: $('#profession1 option:selected').text(),
					  firstname		: $('#firstname').val(),
					  lastname		: $('#lastname').val(),
					  address		: $('#address').val(),
					  zipcode		: $('#zipcode').val(),
					  city			: $('#city1').val(),
					  department	: $('#department1').val(),
					  telephone		: $('#telephone1').val(),
					  email			: $('#email1').val(),
					  password		: $('#password').val(),

				  }

			}).done(function(o){
				//console.log(o);
				$('#modal-content').html(o);

			});

		}

	});


	$('#login').on('click', function(e){

		e.preventDefault();

		url = $('#modal-login').data('url');
		
			$.ajax({
				  type: 'post',
				  url: url,
				  data: { 

					  email			: $('#email_log').val(),
					  password		: $('#password_log').val(),

				  }

			}).done(function(o){
				 
				$('#modal-login-content').html(o);
				if($('#state').data('state') === 'on'){
					$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});
					$.ajax({type:'post',url:'refresh/modal_logout.php'}).done(function(o){$('#modal-logout-content').html(o);});
				}

			});


	});

	$('#logout_yes').on('click', function(e){
		
		e.preventDefault();
		url = $('#modal-logout').data('url');
		$.ajax({
				  type: 'post',
				  url: url
		
		}).done(function(o){
			$('#modal-logout-content').html('<p>A bientôt</p>');
			$.ajax({type:'post',url:'refresh/home.php'}).done(function(o){$('#home').html(o);});
			$.ajax({type:'post',url:'refresh/modal_login.php'}).done(function(o){$('#modal-login-content').html(o);});
			
			
		});
	});

</script>-->
