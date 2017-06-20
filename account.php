<?php

if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])){

       $idUser = (int) $_SESSION['user']['id'];

       // Jointure SQL permettant de récupérer la recette & le prénom & nom de l'utilisateur l'ayant publié
       $selectOne = $bdd->prepare('SELECT u.* FROM user AS u WHERE id = :id');
       $selectOne->bindValue(':id', $idUser, PDO::PARAM_INT);
       if($selectOne->execute()){
           $user = $selectOne->fetch(PDO::FETCH_ASSOC);
       }
       else {
           // Erreur de développement
           var_dump($selectOne->errorInfo());
           die; // alias de exit(); => die('Hello world');
       }
   }
	else{
		header('location:./');
	}

    require('include/connect.php');
    require('include/xheader.php');


	$select = $bdd->prepare('SELECT * FROM profession');

	if($select->execute()){

		$professionAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

	$select = $bdd->prepare('SELECT * FROM offer');

	if($select->execute()){

		$offerAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

		$offer = [];
		$demand = [];
		foreach($offerAvailable as $value){
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

		$cityAvailable = $select->fetchAll(PDO::FETCH_ASSOC);

	}

?>
        

        <!--Main content-->
        <main class=" normalsection">
            <div class="row">
            <!--First container-->
            <div class="container normalsection">

                <!--Section: Features v.4-->
                <section class="section mt-4 feature-box col-xs-12 normalsection" id="features">

                    <!--Secion heading-->
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">WELCOMED</h1><br>

                    <!-- Recherche -->

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->

                
            </div>
            </div>
            <!--/First container-->

            <!--Second container-->
            <div class="container-full whitesection">
                <div class="row">
                <div class="container">

                    <!--Section: About-->
                    <section class="section about mb-4" id="about"> 

                        <div class="row">
                            <h1 class="title normaltitle">Mon Compte</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-md-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Utilisateur :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['lastname'].' '.$user['firstname']; ?></h4>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Spécialité :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['profession']; ?></h4>

                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Téléphone :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['telephone']; ?></h4>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Email :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['email']; ?></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Adresse :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['address']; ?></h4>
                                            
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Ville :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['city']; ?></h4>
                                            <ol class="breadcrumb">
                                                <li class="active">
                                                    <h4>Code Postal :</h4>
                                                </li>
                                            </ol>
                                            <h4><?php echo $user['zipcode'].' '.$user['department']; ?></h4>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <div class="row">
                            <h1 class="title normaltitle">Mes offres</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-md-6">
                                        </div>
                                </div>
                            </div>
                        </div>

                        <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">
                        <div class="row">
                            <h1 class="title normaltitle">Mes messages</h1>
                                <div class="col-sm-12">
                                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                                        <div class="col-md-6">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--/Section: About-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Testimonials v.3-->
                </div>
            </div>
            <!--/Second container-->

        </main>
        <!--/Main content-->

        <?php include 'include/footer.php'; ?>

        <script>

            //Animation init
            new WOW().init();

            // Material Select Initialization
            $(document).ready(function() {
                $('.mdb-select').material_select();
            });

        </script>


<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46172202-4', 'auto');
  ga('send', 'pageview');

</script>
   
    
<script>
	
//	var reference = {};
//	
//	$('.option>span.option').click(function(e){
//        $(this).siblings().css('border','solid #ccc 1px');
//        $(this).css('border','solid #757575 2px');
//		$(this).css('color','#757575');
//		
//        
//        var key     = $(this).data('id');
//        var value   = $(this).data('info');
//		
//		reference[key] = value;
//		
//	});
//	
//	$('.option>span.option2').click(function(e){
//        
//        $(this).css('border','solid #757575 2px');
//		$(this).css('color','#757575');
//		
//        
//        var key     = $(this).data('id');
//        var value   = $(this).data('info');
//		
//		reference[key] = value;
//		
//	});
//				
//	$('#step1').on('click',function(e){
//		
//		e.preventDefault();
//		
//		$.ajax({
//			
//			type	: 'post',
//			url		: '/git/welco-med/import/check_step1.php',
//			data	: {
//				
//				type		: $('#type').val(),
//				profession	: $('#profession').val(),
//				department	: $('#department').val(),
//				city		: $('#city').val(),
//				date_start	: $('#date_start').val(),
//				date_end	: $('#date_end').val()
//			},
//			success : function(o){
//				
//				$('#modal-step1-content').prepend('<p class="text-danger">'+o+'</p>');
//			}
//			
//		});
//		
//	});
//	
//	
//	$('#step2').on('click',function(e){
//		
//		e.preventDefault();
//		
//		$.ajax({
//			
//			type	: 'post',
//			url		: '/git/welco-med/import/check_step2.php',
//			data	: {
//				
//				opening: $('#opening').val(),
//				closing: $('#closing').val(),
//				secretary:reference['secretary'],
//				cb:reference['cb'],
//				check:reference['check'],
//				cash:reference['cash'],
//				access:reference['access'],
//				
//			},
//			success : function(o){
//				
//				$('#modal-step2-content').prepend('<p class="text-danger">'+o+'</p>');
//				var kind = $('#kind').text();
//				if(kind === '1'){$('#step3aForm').removeClass('blind');}else if(kind === '2'){$('#step3bForm').removeClass('blind');}else if(kind === '3'){$('#step3cForm').removeClass('blind');}
//			}
//			
//		});
//		
//	});
//	
//	
//	$('#step3').on('click',function(e){
//		
//		e.preventDefault();
//		
//		$.ajax({
//			
//			type	: 'post',
//			url		: '/git/welco-med/import/check_step3.php',
//			data	: {
//				
//				office:reference['office'],		
//				home:reference['home'],		
//				hour: $('#hour').val(),
//				patient: $('#patient').val(),
//				salary: $('#salary').val(),
//				retrocession: $('#retrocession').val(),
//				exercise: $('#exercise').val(),
//				nbPraticioner: $('#nbPraticioner').val(),
//				software: $('#software').val(),
//				
//			},
//			success : function(o){
//				console.log()
//				$('#modal-step3-content').prepend('<p class="text-danger">'+o+'</p>');
//			}
//			
//		});
//		
//	});
//	
//	$('#step4').on('click',function(e){
//		
//		e.preventDefault();
//		
//		$.ajax({
//			
//			type	: 'post',
//			url		: '/git/welco-med/import/check_step4.php',
//			data	: {
//				
//						title: $('#title').val(),
//						description: $('#description').val(),
//						name: $('#name').val(),
//						email:$('#email').val(),
//						telephone:$('#telephone').val(),
//						
//				
//			},
//			success : function(o){
//				console.log()
//				$('#modal-step4-content').prepend('<p class="text-danger">'+o+'</p>');
//			}
//			
//		});
//		
//	});

				
</script>
    
    

    </body>

</html>