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
    <title>Add Flights</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
    <script>
        $(document).ready(function () {
            $("#error_msg").hide();
            let serviceURL = "http://127.0.0.1:8003/flight/aircrafts";
            getTail(serviceURL);
        });

        async function getTail(serviceURL) {
            let requestParam = {
                headers: {"content-type": "charset=UTF-8"},
                mode: 'cors', // allow cross-origin resource sharing
                method: 'POST'

            }
            try {
                const response = await fetch(serviceURL, requestParam);
                const data = await response.json();
                let aircrafts = data.aircraft;
                console.log(aircrafts);

            } catch (e) {

            }
        }
    </script>
</head>

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
                    <li><a class="waves-effect waves-dark" href="addflights.php" aria-expanded="false"><i
                                    class="mdi mdi-airplane-takeoff"></i><span
                                    class="hide-menu">Add Fight Details</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="../icon-material.html" aria-expanded="false"><i
                                    class="mdi mdi-emoticon"></i><span class="hide-menu">Icons</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="../map-google.html" aria-expanded="false"><i
                                    class="mdi mdi-earth"></i><span class="hide-menu">Google Map</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="../pages-blank.html" aria-expanded="false"><i
                                    class="mdi mdi-book-open-variant"></i><span class="hide-menu">Blank Page</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="../pages-error-404.html" aria-expanded="false"><i
                                    class="mdi mdi-help-circle"></i><span class="hide-menu">Error 404</span></a>
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
                        class="mdi mdi-power"></i></a>
        </div>
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
                    <h3 class="text-themecolor m-b-0 m-t-0">Add Flight Details</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Flight Details</li>
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
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-block">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <div class="col-md-12" id="error_msg">
                                        <P style="color: #c80000;" id="msg_error">Error!</P>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="flight_no" class="col-md-12">Flight Number</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="SFLXXX"
                                               class="form-control form-control-line" name="flight_no"
                                               id="flight_no">
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group col-md-6">
                                        <label for="flight_departure">Flight Departure Date: </label>&nbsp;&nbsp;&nbsp;
                                        <input type="date" id="flight_departure" name="flight_departure"
                                               class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="flight_arrival">Flight Arrival Date: </label>&nbsp;&nbsp;&nbsp;
                                        <input type="date" id="flight_arrival" name="flight_arrival"
                                               class="form-control form-control-line">
                                    </div>
                                </div>
                                </br>

                                <div class="form-group">
                                    <label class="col-md-12">Aircraft Tail Number</label>
                                    <div class="col-md-12" id="dropdown">
                                        <select id="tail_no" placeholder="SFXXXX"
                                                class="form-control form-control-line">
                                            <option disabled selected>Select Aircraft Tail Number</option>
                                        </select>
                                    </div>
                                </div>
                                </br>

                                <div class="form-group">
                                    <h4 class="col-md-12">Pricing Table</h4>
                                    <h5 class="col-md-12">Economy</h5>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Saver</th>
                                            <th>Standard</th>
                                            <th>Plus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align:middle">Economy</td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="econ_sv_price" name="econ_sv_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="econ_sv_seat" name="econ_sv_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="econ_stnd_price" name="econ_stnd_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="econ_stnd_seat" name="econ_stnd_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="econ_plus_price" name="econ_plus_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="econ_plus_seat" name="econ_plus_seat" min="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle">Premium Economy</td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="pr_econ_sv_price" name="pr_econ_sv_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="pr_econ_sv_seat" name="pr_econ_sv_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="pr_econ_stnd_price" name="pr_econ_stnd_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="pr_econ_stnd_seat" name="pr_econ_stnd_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="pr_econ_plus_price" name="pr_econ_plus_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="pr_econ_plus_seat" name="pr_econ_plus_seat" min="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle">Business</td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="bus_sv_price" name="bus_sv_price" min="0.00" step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="bus_sv_seat" name="bus_sv_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="bus_stnd_price" name="bus_stnd_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="bus_stnd_seat" name="bus_stnd_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="bus_plus_price" name="bus_plus_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="bus_plus_seat" name="bus_plus_seat" min="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle">First Class</td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="NA" id="first_sv_price"
                                                       name="first_sv_price" min="0.00" step="any" disabled></br>
                                                <input class="col-md" type="number" placeholder="NA" id="first_sv_seat"
                                                       name="first_sv_seat" min="0" disabled>
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="Price"
                                                       id="first_stnd_price" name="first_stnd_price" min="0.00"
                                                       step="any"></br>
                                                <input class="col-md" type="number" placeholder="# of Seats"
                                                       id="first_stnd_seat" name="first_stnd_seat" min="0">
                                            </td>
                                            <td>
                                                <input class="col-md" type="number" placeholder="NA"
                                                       id="first_plus_price" name="first_plus_price" min="0.00"
                                                       step="any" disabled></br>
                                                <input class="col-md" type="number" placeholder="NA"
                                                       id="first_plus_seat" name="first_plus_seat" min="0" disabled>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                                </br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="button" id="fdsubmit" value="Add Flight" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

            <form id='route-details' method='get' action='autocompletetail.php'>

                <div class="form-group">
                    <input type="hidden" id="flight_no" name="flight_no">
                </div>

            </form>
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
        <footer class="footer">
            © 2017 Material Pro Admin by wrappixel.com
        </footer>
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
</body>

</html>
