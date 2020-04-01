<!DOCTYPE HTML>

<html>
  
<head>
<?php
session_start();
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Flights</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

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

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>

    <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
</head>
	<body>
	<div class="colorlib-loader"></div>
  
	<div id="personal_details">
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h2>Thank you for booking with us!</h2>
				   					<h1>Enter Personal Details</h1>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
           </li>
          </ul>
		  	</div>
    </aside>
              
		<div id="colorlib-reservation">
      
						<div class="tab-content">
            <div id="title"class="colorlib-form">
            <form method="post" action="checkout.php"> 
              <div class="row">
              <div class="col-md-1">
              <div class="form-group">
                  <br>
                 <label for="title"> TTILE:</label>
                      <div class="form-field">
                        <select name="title" id="title" class="form-control">
                          <option value="#">MR</option>
                          <option value="#">MRS</option>
                          <option value="#">MS</option>
                        </select>
                      </div>
                    </div>
                  </div>
              
							<div id="flight" class="tab-pane fade in active">
								<form method="post" class="colorlib-form">
				              	<div class="row">
				              	 <div class="col-md-3">
				              	 	<div class="form-group">
				                    <label for="fname">First Name:</label>
				                    <div class="form-field">
				                      <input type="text" id="firstname" class="form-control" placeholder="First Name">
				                    </div>
				                  </div>
                         </div>
                         <div class="col-md-3">
                          <div class="form-group">
                           <label for="mname">Middle Name:</label>
                           <div class="form-field">
                             <input type="text" id="midname" class="form-control" placeholder="Middle Name">
                           </div>
                         </div>
                        </div>
                         <div class="col-md-3">
                          <div class="form-group">
                           <label for="lname">Last Name:</label>
                           <div class="form-field">
                             <input type="text" id="lastname" class="form-control" placeholder="Last Name">
                           </div>
                         </div>
                        </div>
				                <div class="col-md-2">
                          <div class="form-group">
                           <label for="bday"> BIRTHDAY:</label>
                                <div class="form-field">
                                  <i class="icon icon-arrow-down3"></i>
                                  <select name="day" id="day" class="form-control">
                                    <option value="#">1</option>
                                    <option value="#">2</option>
                                    <option value="#">3</option>
                                    <option value="#">4</option>
                                    <option value="#">5</option>
                                    <option value="#">6</option>
                                    <option value="#">7</option>
                                    <option value="#">8</option>
                                    <option value="#">9</option>
                                    <option value="#">10</option>
                                    <option value="#">11</option>
                                    <option value="#">12</option>
                                    <option value="#">13</option>
                                    <option value="#">14</option>
                                    <option value="#">15</option>
                                    <option value="#">16</option>
                                    <option value="#">17</option>
                                    <option value="#">18</option>
                                    <option value="#">19</option>
                                    <option value="#">20</option>
                                    <option value="#">21</option>
                                    <option value="#">22</option>
                                    <option value="#">23</option>
                                    <option value="#">24</option>
                                    <option value="#">25</option>
                                    <option value="#">26</option>
                                    <option value="#">27</option>
                                    <option value="#">28</option>
                                    <option value="#">29</option>
                                    <option value="#">30</option>
                                    <option value="#">31</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                               <label for="month"> MONTH:</label>
                                    <div class="form-field">
                                      <i class="icon icon-arrow-down3"></i>
                                      <select name="month" id="month" class="form-control">
                                        <option value="#">1</option>
                                        <option value="#">2</option>
                                        <option value="#">3</option>
                                        <option value="#">4</option>
                                        <option value="#">5</option>
                                        <option value="#">6</option>
                                        <option value="#">7</option>
                                        <option value="#">8</option>
                                        <option value="#">9</option>
                                        <option value="#">10</option>
                                        <option value="#">11</option>
                                        <option value="#">12</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                   <label for="year"> YEAR:</label>
                                        <div class="form-field">
                             <input type="text" id="year" class="form-control" placeholder="YYYY">
                           </div>
                         </div>
                        </div>
				                <div class="col-md-2">
                          <a href="checkout.php" id="details_submit" class="btn btn-primary btn-block">Proceed to checkout<a>
				                </div>
				              </div>
				            </form>
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

  </body>
</html>
