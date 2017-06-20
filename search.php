<?php

require('include/connect.php');
require('include/xheader.php');

$select = $bdd->prepare('SELECT profession_id,offer_id,city_id FROM ad');

	if($select->execute()){

		$ads = $select->fetchAll(PDO::FETCH_ASSOC);
	
		$adNb = count($ads);
		$professionList = [];
		$offerList = [];
		$cityList = [];

		foreach($ads as $a){

			$professionList[]=$a['profession_id'];
			$offerList[]=$a['offer_id'];
			$cityList[]=$a['city_id'];

		}

		$professionList = array_unique($professionList);
		$offerList = array_unique($offerList);
		$cityList = array_unique($cityList);

	}

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
                    <h1 class="text-center font-up font-bold mt-1 wow fadeIn" data-wow-delay="0.2s">Découvrez nos offres !</h1><br>

                    <!-- Recherche -->
                    
                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                        <form method="post" class="form-horizonthal col-xs-12" enctype="multipart/form-data">

                                <div class="form-group">
                                        <div class="col-sm-4">
                                            <select name="profession" id="profession" class="form-control">
                                                <option value="0" selected disabled>-- Profession --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <?php foreach ($professionAvailable as $value): 
														if(in_array($value['id'],$professionList)){
												
                                                    echo'<option class="available" value="'.$value['id'].'" >'.$value['speciality'].'</option>';
                                                 	}
													else{
														echo'<option value="'.$value['id'].'" disabled>'.$value['speciality'].'</option>';
													}
													   endforeach; 
												?>
                                            </select>
                                        </div>
                                            

                                        <div class="col-sm-4">
                                            <select name="type" id="type" class="form-control">
                                                <option value="0" selected disabled>-- Type d'annonce --</option>
                                                <!-- On réutilise notre array() ci-dessus -->
                                                <optgroup label="Offre">
                                                <?php foreach($offer as $value){if(in_array($value[0],$offerList)){echo'<option value="'.$value[0].'">'.$value[1].'</option>';
                                                 	}
													else{
														echo'<option value="'.$value[0].'" disabled>'.$value[1].'</option>';
													}
													}//End foreach ?>
                                                <optgroup label="Demande">
                                                <?php foreach($demand as $value){if(in_array($value[0],$offerList)){echo'<option value="'.$value[0].'">'.$value[1].'</option>';
                                                 	}
													else{
														echo'<option value="'.$value[0].'" disabled>'.$value[1].'</option>';
													}
													}//End foreach ?>
                                            </select>
                                        </div>
                                    

                                        <div class="col-sm-4">
											<select name="city" id="city" class="form-control">
												<option value="0" selected disabled>-- Commune --</option>
												<!-- On réutilise notre array() ci-dessus -->
												<?php foreach ($cityAvailable as $key => $value): 
														if(in_array($value['id'],$cityList)){
												?>
													<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
												<?php	}
															endforeach; 
												?>
											</select>
                                        </div>
                                
                            
                            

                        </div>
<!--
                            <div class="text-center">
                               <p id="nbAd"></p>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </div>
                            </div>
                        
-->
                    </form>
                    </div>

                </section>
                <!--/Section: Features v.4-->

                <hr class="between-sections wow fadeIn" data-wow-delay="0.4s">

                <!--Section: Products-->

                
            </div>
            </div>
            <!--/First container-->
          
            <!--Second container-->
            <div class="container-full whitesection">
                <div class="container">

                    <!--Section: About-->
                    <section class="section about mb-4" id="about"> 

                        <div class="row">
                            <h1 class="title normaltitle">Résultat de votre recherche</h1>
                                <div class="col-sm-12">
                                    <div class="col-md-12" id="search_result">

                                    
                                    <!--         Résultat de la recherche   	 -->
        
    
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
            
           
          
<?php

	require('include/footer.php');
	
			
?>


<script>
	
	var search = '/git/ProjetWelcomed/ajax/search_result.php'

			
			$('#profession').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: search,
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()
					},
					success	: function(r){
						console.log(r);
						$('#search_result').html(r);
					}
				});
			});
			
/////////////////////////////////////////
			
			$('#type').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: search,
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()	
					},
					success	: function(r){
						console.log(r);
						$('#search_result').html(r);
					}
				});
			});
			
/////////////////////////////////////////
			
			$('#city').on('change',function(){
				
				$.ajax({
					
					type	: 'post',
					url		: search,
					data	: {
							profession_id	: $('#profession').val(),
							offer_id	: $('#type').val(),
							city_id	: $('#city').val()	
					},
					success	: function(r){
						console.log(r);
						$('#search_result').html(r);
					}
				});
			});

</script>


</body>


</html>