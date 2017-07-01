<?php 
session_name('wmd'); session_start();

require('../include/route.php');

?>
<!--Links-->
                        

                        <?php if(!isset($_SESSION['user'])){?>
                            <a class="btn wmlogin mod buttonwc" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Connectez-vous pour accèder à nos offres</a>
                            <?php }else{?>
                            
                            <a class="btn wmlogin buttonwc" href="http://welcomed-solutions.strikingly.com/">Accédez à nos offres</a>


               
                        <?php }?>
                    


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