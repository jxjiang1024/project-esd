<!DOCTYPE HTML>
<html>
<?php
session_start();
if (!isset($_POST["from"])) {
    header("location:index.html");
}
?>
<head>
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


    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->

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

    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/table_flight.css">
    <!--===============================================================================================-->

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
                if (isset($_POST["from"]) && isset($_POST["to"]) && isset($_POST["start_date"]) && $_POST["end_date"] != "") {
                    $departcty = $_POST["from"];
                    $arrcty = $_POST["to"];
                    $departdate = $_POST["start_date"];
                    $arrdate = $_POST["end_date"];
                    echo "<h2>You have searched a flight from " . $_POST["from"] . " to " . $_POST["to"] . "</h2>";
                    echo "<h2>From " . $_POST["start_date"] . " to " . $_POST["end_date"] . "</h2>";
                } elseif (isset($_POST["from"]) && isset($_POST["to"]) && isset($_POST["start_date"])) {
                    $departcty = $_POST["from"];
                    $arrcty = $_POST["to"];
                    $departdate = $_POST["start_date"];
                    echo "<h2>You have searched a flight from " . $_POST["from"] . " to " . $_POST["to"] . " on " . $_POST["start_date"] . "</h2>";
                } else {
                    header("Location: index.html");
                }

                ?>
            </div>
            <form>
                <div class="limiter">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <div class="table100 ver1 m-b-110">
                                <div class="table100-head">
                                    <table>
                                        <thead>
                                        <tr class="row100 head">
                                            <th class="cell100 column1">Selection</th>
                                            <th class="cell100 column2">Flight No</th>
                                            <th class="cell100 column3">Departure Time</th>
                                            <th class="cell100 column4">Arrival Time</th>
                                            <th class="cell100 column5">Price</th>
                                            <th class="cell100 column5">Availability</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="table100-body js-pscroll">
                                    <table id="data">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="align:left;">
                    <a class="btn btn-warning" href="pdetails.php" role="button">Proceed to Personal Details</a>
                </div>
            </form>
        </div>


    </div>


    <div id="colorlib-subscribe" style="background-image: url(images/img_bg_2.jpg);"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                    <h2>Sign Up for a Newsletter</h2>
                    <p>Sign up for our mailing list to get latest updates and offers.</p>
                </div>
            </div>
        </div>
    </div>


    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>


<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
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

<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Main -->
<script src="js/main.js"></script>
<script>

    $("subscribe").click(function () {
        alert("Thank you for your subsription");
    });


    $(document).ready(function () {
        let serviceURL = "http://127.0.0.1:8003/flight/findFlights";// Input your Microservice URL
        let check = "<?php echo $_POST['check']?>";
        let start_date = "<?php echo $_POST['start_date']?>";
        let isReturn = true;
        let end_date = "<?php if ($_POST['check'] == 1) {
            echo "None";
        } else {
            echo $_POST['end_date'];
        }?>";
        if (end_date == "None") {
            isReturn = false;
        }
        let from = "<?php echo $_POST['from']?>";
        let to = "<?php echo $_POST['to']?>";
        let NoTravellers = "<?php echo $_POST['travellers']?>";
        start_date = new Date(start_date);
        console.log(start_date.getDate());
        let month = start_date.getMonth() + 1
        start_date = start_date.getFullYear() + "-" + month.toString() + "-" + start_date.getDate();
        getRoutes(serviceURL, from, to, isReturn, start_date, end_date);

    });

    async function getRoutes(serviceURL, from, to, isReturn, start_date, end_date) {
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
            console.log(data);
            // Check for return
            var flights = data.flights;
            // only showing econs standard
            let rows = "";
            for (const flight of flights) {
                eachRow =
                    "<td class=\"cell100 column1\"><input  TYPE=radio name='flight_id' value='" + flight.flight_details_id + "'/></td>" +
                    "<td class=\"cell100 column2\">" + flight.flight_no + "</td>" +
                    "<td class=\"cell100 column3\">" + flight.flight_departure + "</td>" +
                    "<td class=\"cell100 column4\">" + flight.flight_arrival + "</td>" +
                    "<td class=\"cell100 column5\">" + flight.econ_stnd_price + "</td>" +
                    "<td class=\"cell100 column6\">" + flight.econ_stnd_seat + "</td>";
                rows += "<tbody><tr class=\"row100 body\">" + eachRow + "</tr></tbody>";
            }
            $('#data').append(rows);

        } catch (e) {
            console.log(e);

        }
    }

    $('.js-pscroll').each(function () {
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function () {
            ps.update();
        })
    });

</script>
<script src="js/table_flight.js"></script>

</body>

</html>

