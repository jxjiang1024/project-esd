<!DOCTYPE HTML>

<html>
<?php if (!isset($_GET["flight_id"])) {
    header("location:index.html");
}
if (!isset($_GET['check'])) {
    header("location:index.html");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Enter Personal Details</title>
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
            <div id="title" class="colorlib-form">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2 style="color: white">Tickets Details</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="flight_number"> Flight Number:</label>
                                <div class="form-field">
                                    <p><b id="flight_number"></b></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($_GET['check'] == "0") { ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="flight_number">Return Flight Number:</label>
                                    <div class="form-field">
                                        <p><b></b></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="depart_date">Departure Airport:</label>
                                <div class="form-field">
                                    <p><b><?php echo $_GET['departure_airport']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="depart_date">Departure Date:</label>
                                <div class="form-field">
                                    <p><b><?php echo $_GET['departure_date']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="depart_date">Departure Time:</label>
                                <div class="form-field">
                                    <p><b id="departure_time"></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="depart_date">Departure Airport:</label>
                                <div class="form-field">
                                    <p><b><?php echo $_GET['arrival_airport']; ?></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="arrival_Date">Arrival Airport:</label>
                                <div class="form-field">
                                    <p><b><?php echo $_GET['arrival_airport']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="arrival_Date">Arrival Date:</label>
                                <div class="form-field">
                                    <p><b><?php echo $_GET['arrival_date']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="arrival_Date">Arrival Time:</label>
                                <div class="form-field">
                                    <p><b id="arrival_time"></b></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($_GET['check'] == "0") { ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="arrival_Date">Departure Airport:</label>
                                    <div class="form-field">
                                        <p><b><?php echo $_GET['departure_airport']; ?></b></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price">Ticket Price:</label>
                                <div class="form-field">
                                    <p><b id="ticket_price"></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="container">
                    <form method="post" action="checkout.php">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"><h2 style="color: white">Personal Details</h2></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="title"> Title:</label>
                                        <div class="form-field">
                                            <select name="title" id="title" class="form-control">
                                                <option style="color:black;" value="MR">MR</option>
                                                <option style="color:black;" value="MRS">MRS</option>
                                                <option style="color:black;" value="MS">MS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">First Name:</label>
                                        <div class="form-field">
                                            <input type="text" name="fname" id="firstname" class="form-control"
                                                   placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mname">Middle Name:</label>
                                        <div class="form-field">
                                            <input type="text" name="midname" id="midname" class="form-control"
                                                   placeholder="Middle Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lname">Last Name:</label>
                                        <div class="form-field">
                                            <input type="text" name="lastname" id="lastname" class="form-control"
                                                   placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Birthday-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bday"> Birthday:</label>
                                        <div class="form-field">
                                            <input type="date" id="birthday" name="birthday"
                                                   class="form-control" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Email-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bday"> Email:</label>
                                        <div class="form-field">
                                            <input type="text" id="email" name="email"
                                                   class="form-control" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Address-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="street">Street Address:</label>
                                        <div class="form-field">
                                            <input type="text" id="street" class="form-control"
                                                   placeholder="Street Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="town">Town/City:</label>
                                        <div class="form-field">
                                            <input type="text" id="town" class="form-control"
                                                   placeholder="Town/City">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="country">Country:</label>
                                        <div class="form-field">
                                            <input type="text" id="country" class="form-control"
                                                   placeholder="Country">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="state">Zip/State Code:</label>
                                        <div class="form-field">
                                            <input type="text" id="zip" class="form-control"
                                                   placeholder="Zip/State Code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="submit" name="details_submit" id="details_submit"
                                           value="Proceed to checkout" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
<script>
    $(document).ready(function () {
        let serviceURL = "http://127.0.0.1:8003/flight/findFlights";
        let check = "<?php echo $_GET['check']?>";
        let start_date = "<?php echo $_GET['departure_date']?>";
        let isReturn = true;
        let flight_details_id = "<?php echo $_GET['flight_id'];?>";
        let end_date = "<?php if ($_GET['check'] == 1) {
            echo "None";
        } else {
            echo $_GET['arrival_date'];
        }?>";
        if (end_date == "None") {
            isReturn = false;
        } else {
            end_date = new Date(end_date);
            let end_month = end_date.getMonth() + 1
            end_date = end_date.getFullYear() + '-' + end_month.toString() + '-' + end_date.getDate();
        }
        let from = "<?php echo $_GET['departure_airport']?>";
        let to = "<?php echo $_GET['arrival_airport']?>";
        start_date = new Date(start_date);
        let month = start_date.getMonth() + 1
        start_date = start_date.getFullYear() + "-" + month.toString() + "-" + start_date.getDate();

        getRoutes(serviceURL, from, to, isReturn, start_date, end_date, check, flight_details_id);

    });

    async function getRoutes(serviceURL, from, to, isReturn, start_date, end_date, check, flight_details_id) {
        try {
            const response =
                await fetch(
                    serviceURL, {
                        headers: {"Content-Type": "application/json"},
                        method: 'POST',
                        mode: 'cors',
                        body: JSON.stringify({
                            departureAirport: from,
                            arrivalAirport: to,
                            departDate: start_date,
                            isReturn: isReturn,
                            returnDate: end_date
                        })
                    }
                );
            const data = await response.json();
            // Check for return
            let flights = data.flights;
            for (const flight of flights) {
                if (flight.return == false && flight.flight_details_id == flight_details_id.toString()) {
                    $("#flight_number").text(flight.flight_no.toString());
                    $("#departure_time").text(flight.departure_time.toString());
                    $("#arrival_time").text(flight.arrival_time.toString());
                    $("#ticket_price").text("S$ " + flight.econ_stnd_price.toString());
                }
            }
        } catch (e) {

        }
    }
</script>
</body>
</html>
