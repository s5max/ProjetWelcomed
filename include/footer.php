<!--Footer-->
        <footer class="page-footer footer-tiles center-on-small-only pt-4 normalfooter" id="footer">

            <!--Footer Links-->
            <div class="container mb-4">

                <!--First row-->
                <div class="row">

                    <!--First column-->
                    <div class="col-xl-4 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <!--About-->
                        <h5 class="title mb-1 normaltitlefoot"><strong>A PROPOS DE NOUS</strong></h5>

                        <p><a href="contact.php">Contact</a></p>

                        <p class="mb-1-half"><a href="legal.php">Mentions Légales</a></p>

                        <!--/About -->
                    </div>
                    <!--/First column-->

                    <hr class="w-100 hidden-lg-up">

                    <!--Second column-->
                    <div class="col-xl-4 offset-xl-1 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">
                        <!--Info-->
                        <p><i class="fa fa-home mr-3"></i> Route de l'entraide</p>
                        <p><i class="fa fa-home mr-3"></i> 97200 Fort-de-France</p>
                        <p><i class="fa fa-envelope mr-3"></i> welcomed@gmail.com</p>

                    </div>
                    <!--/Second column-->

                    <hr class="w-100 hidden-lg-up">

                    <!--First column-->
                    <div class="col-xl-4 col-lg-4 pt-1 pb-1 wow fadeIn" data-wow-delay="0.3s">

                        <div class="footer-socials">

                            <!--Facebook-->
                            <a type="button" class="btn-floating btn-small btn-primary"><i class="fa fa-facebook"></i></a> facebook.com/welcomedsolutions/

                        </div>
                    </div>
                    <!--/First column-->

                </div>
                <!--/First row-->

            </div>
            <!--/Footer Links-->

            <!--Copyright-->
            <div class="footer-copyright wow fadeIn" data-wow-delay="0.3s">
                <div class="container-fluid">
                    <p>© 2017 Copyright: Welcomed</p>
                </div>
            </div>
            <!--/Copyright-->

        </footer>
        <!--/Footer Links-->



        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
</script>      