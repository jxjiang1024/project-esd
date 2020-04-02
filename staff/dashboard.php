<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("location:../login.php");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Staff Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
<script>
    $(document).ready(function () {
        $("#tableError").hide();
        $("#errorFlight").hide();
        let serviceURL = "http://127.0.0.1:8003/flight/route";
        getRoutesData(serviceURL);
        serviceURL = "http://127.0.0.1:8003/flight/details";
        getFlights(serviceURL);
    });

    async function getRoutesData(serviceURL) {
        let requestParam = {
            headers: {"content-type": "charset=UTF-8"},
            mode: 'cors', // allow cross-origin resource sharing
            method: 'GET',

        }
        try {
            const response = await fetch(serviceURL, requestParam);
            const data = await response.json();
            let route = data.route;

            if (data.result == true) {
                var rows = "";
                for (const listRoute of route) {
                    eachRow =
                        "<td>" + listRoute.flight_no + "</td>" +
                        "<td>" + listRoute.departure_airport_id + "</td>" +
                        "<td>" + listRoute.arrival_airport_id + "</td>" +
                        "<td>" + listRoute.departure_time + "</td>" +
                        "<td>" + listRoute.arrival_time + "</td>";
                    rows += "<tbody><tr>" + eachRow + "</tr></tbody>";

                }
                // add all the rows to the table
                $('#routeListTable').append(rows);
            } else {
                $("#tableError").show();
                $("#routeListTable").hide();
                $("#routes").hide();


            }
        } catch (e) {
            console.error(e)
            $("#tableError").show();
            $("#routeListTable").hide();
            $("#routes").hide();
        }


    }

    async function getFlights(serviceURL) {
        let requestParam = {
            headers: {"content-type": "charset=UTF-8"},
            mode: 'cors', // allow cross-origin resource sharing
            method: 'GET',

        }
        try {
            const response = await fetch(serviceURL, requestParam);
            const data = await response.json();
            let flight = data.flight;
            if (data.result == true) {

                let rows = "";
                for (const listFlight of flight) {
                    let departureDate = new Date(listFlight.flight_departure);
                    let arrivalDate = new Date(listFlight.flight_arrival);
                    let departureMonth = departureDate.getMonth() + 1;
                    let arrivalMonth = arrivalDate.getMonth() + 1;
                    eachRow =
                        "<td>" + listFlight.tail_no + "</td>" +
                        "<td>" + listFlight.economy_seats + "</td>" +
                        "<td>" + listFlight.premium_economy_seats + "</td>" +
                        "<td>" + listFlight.business_seats + "</td>" +
                        "<td>" + listFlight.first_class_seats + "</td>" +
                        "<td>" + departureDate.getDate().toString() + "/" + departureMonth.toString() + "/" + departureDate.getFullYear().toString() + "</td>" +
                        "<td>" + arrivalDate.getDate().toString() + "/" + arrivalMonth.toString() + "/" + arrivalDate.getFullYear().toString() + "</td>" +
                        "<td>" + listFlight.status + "</td>";
                    rows += "<tbody><tr>" + eachRow + "</tr></tbody>";
                }
                // add all the rows to the table
                $('#flightTable').append(rows);

            } else {
                $("#errorFlight").show();
                $("#flightTable").hide();
                $("#addFlight").hide();
            }
        } catch (e) {
            console.error(e);
            $("#errorFlight").show();
            $("#flightTable").hide();
            $("#addFlight").hide();
        }
    }
</script>
<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                        <!-- Light Logo icon -->
                        <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo"/>
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text --><span>

                         <!-- Light Logo text -->
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage"/></span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto mt-md-0">
                    <!-- This is  -->
                    <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                            href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item hidden-sm-down search-box"><a
                                class="nav-link hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i
                                        class="ti-close"></i></a></form>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="../assets/images/users/1.jpg" alt="user"
                                    class="profile-pic m-r-10"/><?php echo $_SESSION['prefix'], " ", $_SESSION['first_name'], ", ", $_SESSION['last_name'] ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li><a class="waves-effect waves-dark" href="dashboard.php" aria-expanded="false"><i
                                    class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i
                                    class="mdi mdi-account-check"></i><span class="hide-menu">Profile</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="add_route.php" aria-expanded="false"><i
                                    class="mdi mdi-earth"></i><span class="hide-menu">Add More Routes</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="addflights.php" aria-expanded="false"><i
                                    class="mdi mdi-airplane-takeoff"></i><span
                                    class="hide-menu">Add Flight Details</span></a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
            <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
            <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
            <!-- item--><a href="../logout.php" class="link" data-toggle="tooltip" title="Logout"><i
                        class="mdi mdi-power"></i></a></div>
        <!-- End Bottom points-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title">Current Routes</h4>
                            <div class="table-responsive" id="tableError"><p>No Records Found</p></div>
                            <div class="table-responsive">
                                <table class="table" id="routeListTable">
                                    <thead>
                                    <tr>
                                        <th>Flight No.</th>
                                        <th>Departure Airport</th>
                                        <th>Arrival Airport</th>
                                        <th>Departure Time</th>
                                        <th>Arrival Time</th>
                                    </tr>
                                    </thead>

                                </table>
                                <a style="float: right;" id="routes" href="add_route.php" class="btn btn-success">
                                    Add More Routes</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Row -->
            <div class="row">
                <!-- Column -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title">Current Flights</h4>
                            <div class="table-responsive" id="errorFlight"><p>No Records Found</p></div>
                            <div class="table-responsive">
                                <table class="table" id="flightTable">
                                    <thead>
                                    <tr>
                                        <th>Aircraft Assigned</th>
                                        <th>Economy Seats</th>
                                        <th>Premium Economy Seats</th>
                                        <th>Business Class Seats</th>
                                        <th>First Class Seats</th>
                                        <th>Departure Date</th>
                                        <th>Arrival Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>

                                </table>
                                <a style="float: right;" id = "addFlight" href="addflights.php" class="btn btn-success">
                                    Add More Flights</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- Row -->
        <!-- Row -->

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer"> © 2017 Material Pro Admin by wrappixel.com</footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- chartist chart -->
<script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!--c3 JavaScript -->
<script src="../assets/plugins/d3/d3.min.js"></script>
<script src="../assets/plugins/c3-master/c3.min.js"></script>
<!-- Chart JS -->
<script src="js/dashboard1.js"></script>
</body>

</html>
