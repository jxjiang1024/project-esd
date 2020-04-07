<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout</title>
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
	<div id="personal_details">
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Enter your Billing Details</h1>
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
            <div class="container"> 
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="payment"> Choose Payment Method:</label>
                      <div class="form-field">
                        <select name="payment" id="payment" class="form-control">
                          <option style="color:black;" value="CC">Credit Card</option>
                          <option style="color:black;" value="Paypal">PayPal</option>
                          <option style="color:black;" value="Voucher">Voucher</option>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="ctype"> Choose Card Type:</label>
                      <div class="form-field">
                        <select name="ctype" id="ctype" class="form-control">
                          <option style="color:black;" value="Visa">VISA</option>
                          <option style="color:black;" value="mastercard">MasterCard</option>
                          <option style="color:black;" value="aexpress">American Express</option>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="lname">Name on Card:</label>
                    <div class="form-field">
                      <input type="text" name="cname" id="cname" class="form-control" placeholder="Enter Name">
                    </div>
                  </div>
                </div>
              </div>
                  
                
              <!--Card Number-->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    &nbsp;&nbsp;<label for="cno"> Card Number:</label>
                    <div class="form-field">
                      <input type="text" id="cno" name="cno" 
                        class="form-control" placeholder="Enter Card.No">
                    </div>
                  </div>
                </div>
              </div>
              <!--date/cvv-->
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="cvv"> Expiration Date:</label>
                    <div class="form-inline">
                      <select id="edate-month" class="form-control">
                        <option selected hidden>MM</option>
                        <option style="color:black;" value="1">01</option>
                        <option style="color:black;" value="2">02</option>
                        <option style="color:black;" value="3">03</option>
                        <option style="color:black;" value="4">04</option>
                        <option style="color:black;" value="5">05</option>
                        <option style="color:black;" value="6">06</option>
                        <option style="color:black;" value="7">07</option>
                        <option style="color:black;" value="8">08</option>
                        <option style="color:black;" value="9">09</option>
                        <option style="color:black;" value="10">10</option>
                        <option style="color:black;" value="11">11</option>
                        <option style="color:black;" value="12">12</option>
                      </select> /
                      <select id="edate-year" class="form-control" placeholder="YY">
                        <option selected hidden>YYYY</option>
                        <option style="color:black;" value="2020">2020</option>
                        <option style="color:black;" value="2021">2021</option>
                        <option style="color:black;" value="2022">2022</option>
                        <option style="color:black;" value="2023">2023</option>
                        <option style="color:black;" value="2024">2024</option>
                        <option style="color:black;" value="2025">2025</option>
                        <option style="color:black;" value="2026">2026</option>
                        <option style="color:black;" value="2027">2027</option>
                        <option style="color:black;" value="2028">2028</option>
                        <option style="color:black;" value="2029">2029</option>
                        <option style="color:black;" value="2030">2030</option>
                      </select>
                      </div>
                  </div>
                </div>
              </div>     
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="cvv"> CVV:</label>
                    <div class="form-field">
                      <input type="text" id="cvv" name="cvv" 
                        class="form-control" placeholder="Enter CVV">
                    </div>
                  </div>
                </div>
              </div>     
				                <div class="col-md-2">
                          <input type="button" onclick="showalert()" name="checkout" id="checkout "class="btn btn-primary btn-block"value="Confirm booking!">
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
<script>
    $(document).ready(function () {
        let serviceURL = "http://127.0.0.1:8300/payment/check";
        let title = "<?php echo $_POST['title']?>";
        let firstname = "<?php echo $_POST['firstname']?>";
        let midname = "<?php echo $_POST['midname']?>";
        let lastname = "<?php echo $_POST['lastname']?>";
        let email1 = "<?php echo $_POST['email']?>";

        });

      async function check_payment(serviceURL,title,firstname,midname,lastname,email){
        try {
          const response =
            await fetch(
              serviceURL, {
              headers: {"Content-Type": "application/json"},
						  method: 'POST',
						  mode: 'cors',
						  body: JSON.stringify({
                prefix: title,
                first_name:firstname,
                mid_name:midname,
                last_name:lastname,
                email:email1              
                
              })
              }

            );
      const data = await response.json();
      let details=data.details;
      console.log(details);
      }
      
			catch (e) {
				console.log(e);
      }
      };
		
  </script>

</html>

