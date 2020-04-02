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
							<div id="flight" class="tab-pane fade in active">
								<div class="colorlib-form">
				              	<div class="row">
				              	 <div class="col-md-3">
				              	 	<div class="form-group">
				                    <label for="street">Street Address:</label>
				                    <div class="form-field">
				                      <input type="text" id="street" class="form-control" placeholder="Street Name">
				                    </div>
				                  </div>
				              	 </div>
                         <div class="col-md-2">
                          <div class="form-group">
                           <label for="town">Town/City:</label>
                           <div class="form-field">
                             <input type="text" id="town" class="form-control" placeholder="Town/City">
                           </div>
                         </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                           <label for="country">Country:</label>
                           <div class="form-field">
                             <input type="text" id="country" class="form-control" placeholder="Country">
                           </div>
                         </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                           <label for="state">Zip/State Code:</label>
                           <div class="form-field">
                             <input type="text" id="zip" class="form-control" placeholder="Zip/State Code">
                           </div>
                         </div>
                        </div>
                            <div class="col-md-2">
                              <div class="form-group">
                               <label for="payment"> Choose Payment Method:</label>
                                    <div class="form-field">
                                      <i class="icon icon-arrow-down3"></i>
                                      <select name="payment" id="payment" class="form-control">
                                        <option style="color:black;" value="#">Credit Card</option>
                                        <option style="color:black;" value="#">Paypal</option>
                                        <option style="color:black;" value="#">Voucher</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
				                <div class="col-md-2">
                          <input type="button" name="checkout" onclick="clickAlert()" id="checkout "class="btn btn-primary btn-block"value="Confirm booking!">
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
  function clickAlert() {
    alert("Thank you for booking with us!");
  }
  </script>
<script>
    $(document).ready(function () {

      $("#checkout").click(function () {
        let serviceURL = "http://127.0.0.1:8300/payment/check";
        let payment = $("#payment").val();
        let title=<?php echo $_POST['title']?>;
        let firstname=<?php echo $_POST['firstname']?>;
        let midname=<?php echo $_POST['midname']?>;
        let lastname=<?php echo $_POST['lastname']?>;
        })
    	$(async () => {
			let requestParam = {
						headers: {"Content-Type": "application/json"},
						method: 'POST',
						mode: 'cors',
						body: JSON.stringify({
            first_name:firstname,
            last_name:lastname,
            middle_name:midname,
            prefix:title,
            payment_type:payment})
		};
		try
    {
			const response = await fetch(serviceURL, requestParam);
      const data = await response.json();
      console.log(data);
      }
      
			catch (e) {
				console.log(e);
      }
    })
    });
		
  </script>

</html>

