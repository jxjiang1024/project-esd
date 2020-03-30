<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>View Flights</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    </head>
   
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/cover-img-4.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>Amazing Airline</h2>
				   					<h1>Find Flights</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
        </aside>
        
		<div class="colorlib-wrap">
			<div class="container">
                <div>
                    <?php
                    if (isset($_POST["two-way-from"]) && isset($_POST["two-way-to"]) && isset($_POST["two-way-startdate"]) && isset($_POST["two-way-enddate"])) {
                        echo "<h2>You have searched a flight from ".$_POST["two-way-from"]." to ".$_POST["two-way-to"]."</h2>";
                        echo "<h2>From ".$_POST["two-way-startdate"]." to ".$_POST["two-way-enddate"]."</h2>";
                    }elseif(isset($_POST["one-way-from"]) && isset($_POST["one-way-to"]) && isset($_POST["one-way-date"])){
                        echo "<h2>You have searched a flight from ".$_POST["one-way-from"]." to ".$_POST["one-way-to"]." on ".$_POST["one-way-date"]."</h2>";
                    }else{
                        header("Location: index.html");
                    }
                    
                    ?>
                </div>
                
                <!-- <div id="results">
                <table id="go-flight" class='table table-striped' border='1'>
                    <thead>
                        <th>Deapture Airport</th>
                        <th>Arrival Airport</th>
                        <th>Depature Time </th>
                        <th>Availability</th>
                    </thead>
                </table>
                </div> -->



            </div>
            
				
		</div>

	
		<div id="colorlib-subscribe" style="background-image: url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Sign Up for a Newsletter</h2>
						<p>Sign up for our mailing list to get latest updates and offers.</p>
						<form class="form-inline qbstp-header-subscribe">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="form-group">
										<input type="text" class="form-control" id="email" placeholder="Enter your email">
										<button type="submit" class="btn btn-primary">Subscribe</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		</footer> --> 
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Main -->
	<script src="js/main.js"></script>
    <?php
                    if (isset($_POST["two-way-from"]) && isset($_POST["two-way-to"]) && isset($_POST["two-way-startdate"]) && isset($_POST["two-way-enddate"])) {
                        echo "<h2>You have searched a flight from ".$_POST["two-way-from"]." to ".$_POST["two-way-to"]."</h2>";
                        echo "<h2>From ".$_POST["two-way-startdate"]." to ".$_POST["two-way-enddate"]."</h2>";
                    }elseif(isset($_POST["one-way-from"]) && isset($_POST["one-way-to"]) && isset($_POST["one-way-date"])){
                        echo "<h2>You have searched a flight from ".$_POST["one-way-from"]." to ".$_POST["one-way-to"]." on ".$_POST["one-way-date"]."</h2>";
                    }else{
                        header("Location: index.html");
                    }
                    
                    ?>
    </body>
    <script>
    $(document).ready(function () {
        let two_way_from = "<?php echo $_POST["two-way-from"];?>"
        let two_way_to = "<?php echo $_POST["two-way-to"];?>"
        let two_way_startdate = "<?php echo $_POST["two-way-startdate"];?>"
        let two_way_enddate = "<?php echo $_POST["two-way-enddate"];?>"
        let one_way_from = "<?php echo $_POST["one-way-from"];?>"
        let one_way_to = "<?php echo $_POST["one-way-to"];?>"
        let one_way_date = "<?php echo $_POST["one-way-date"];?>"

        let flightURL = "http://127.0.0.1:8003/flight/findFlights"
        
        $(async () => {
                    try {
                        const response =
                            await fetch(
                                flightURL, {
                                    headers: {"Content-Type": "application/json"},
                                    method: 'POST',
                                    mode: 'cors',
                                    body: JSON.stringify({p: password})
                                }
                            );
                        const data = await response.json();

                        if (data.result == true) {
                            $.post("session_staff.php", {
                                "staff_id": data.staff_id,
                                "first_name": data.first_name,
                                "last_name": data.last_name,
                                "prefix": data.prefix,
                                "middle_name": data.middle_name,
                                "suffix": data.suffix,
                                "email": email,
                                "roles": data.roles,
                                "country": data.country_name,
                                "country_code": data.country_code
                            });

                            location.reload();
                        } else {
                            $("#loadingwheel").hide();
                            $("#error_msg").show();
                        }
                    } catch (e) {
                        $("#loadingwheel").hide();
                        $("#error_msg").show();
                    }

                });

 

    });


    </script>
</html>

