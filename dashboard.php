<?php

include_once 'db.php';
?>
<?php

require_once('db.php');

?>

<?php
session_start();
if (!isset($_SESSION['sess_username'])) {
    header('Location: index.php?err=2');
}

date_default_timezone_set("Africa/Nairobi");
// echo "Europe/Helsinki:".time(); 
// echo "<br>"; 
?>
<?php
$sql = "SELECT count(*) FROM t_items_warranty   ";
$result = $DB_con->prepare($sql);
$result->execute();
$number_of_rows = $result->fetchColumn();
?>
<!-- This is items posted per day -->
<?php
$sql = "SELECT count(POSTEDAT) FROM t_items_warranty";
$result1 = $DB_con->prepare($sql);
$result1->execute();
$number_of_rows1 = $result1->fetchColumn();
?>
<!-- count signed off items-->
<?php
//order total records of units.
$sql = "SELECT count(SIGNOFF) FROM T_ITEMS_WARRANTY WHERE SIGNOFF = '1' order by POSTEDAT";
$result2 = $DB_con->prepare($sql);
$result2->execute();
// end of intial unit count...
$number_of_rows2 = $result2->fetchColumn();
?>

<?php
$sql = "SELECT count(*) FROM T_PARTSAWAITED_WARRANTY ";
$result4 = $DB_con->prepare($sql);
$result4->execute();
$number_of_rows4 = $result4->fetchColumn();
?>
<?php
$sql = "SELECT count(UPDATEDDATE) FROM T_PARTSAWAITED_WARRANTY ";
$result5 = $DB_con->prepare($sql);
$result5->execute();
$number_of_rows5 = $result5->fetchColumn();
?>
<?php
$sql = "SELECT count(*) FROM T_PARTSAWAITED_WARRANTY WHERE SIGNOFF='1' order by dateofentry ";
$result6 = $DB_con->prepare($sql);
$result6->execute();
$number_of_rows6 = $result6->fetchColumn();
?>
<?php
$sql = "SELECT count(*) FROM T_PARTSAWAITED_WARRANTY WHERE SIGNOFF='0' ";
$result7 = $DB_con->prepare($sql);
$result7->execute();
$number_of_rows7 = $result7->fetchColumn();
?>
<!-- This is count unsigned items-->
<?php
$sql = "SELECT count(SIGNOFF) FROM T_ITEMS_WARRANTY WHERE SIGNOFF = '0' ";
$result3 = $DB_con->prepare($sql);
$result3->execute();
$number_of_rows3 = $result3->fetchColumn();
?>


<!-- for curerent date
select count(*)
from t
//where str_to_date(stupid_date_column, '%d-%m-%Y') <= curdate();-->


<html lang="en">
<head>
    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->

    <title>KQ Workshop Tracker.</title>

    <!-- <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" /> -->


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>

    <!--   <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/> -->


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/> -->
    <script type="text/javascript"
            src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

</head>
<body>

<div class="wrapper">

    <div class="sidebar" data-background-color="black" data-active-color="danger">

        <!--
                               Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                               Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
                  -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text"><img src="assets/img/kqicon.png" height="30px" width="30px"/>
                    Workshop
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="categories.php">
                        <i class="ti-briefcase"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>

                <li>
                    <a href="additem.php">
                        <i class="ti-save-alt"></i>
                        <p>AddItem</p>
                    </a>
                </li>
                <li>
                    <a href="addaircraft.php">
                        <i class="ti-location-arrow"></i>
                        <p>Aircraft Type</p>
                    </a>
                </li>
                <li>
                    <a href="aircraftregnum.php">
                        <i class="ti-notepad"></i>
                        <p>Aircraft Reg Number</p>
                    </a>
                </li>
                <li>
                    <a href="unit.php">
                        <i class="ti-bag"></i>
                        <p>Add Unit</p>
                    </a>
                </li>
                <li>
                    <a href="parts_awaited.php">
                        <i class="ti-settings"></i>
                        <p>Parts Awaited</p>
                    </a>
                </li>
                <li>
                    <a href="report.php">
                        <i class="ti-stats-up"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li>
                    <a href="manageusers.php">
                        <i class="ti-user"></i>
                        <p>Manage Users</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">DASHBOARD</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">


                        <li>
                            <a href="#">
                                <i class="ti-alarm-clock">&nbsp</i>
                                <?php echo date("d-M-Y h:i:s a"); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-user">&nbsp;</i>
                                <?php echo $_SESSION['displayname']; ?>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="ti-settings"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-shopping-cart-full"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>TOTAL ITEMS</p>
                                                <?php echo $number_of_rows; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-rocket"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>ITEMS PER DAY</p>
                                                <?php echo $number_of_rows1 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <div class="footer">
                                         <hr />
                                         <div class="stats">
                                             <i class="ti-reload"></i> Updated now
                                         </div>
                                     </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>SIGNED ITEMS</p>
                                                <?php echo $number_of_rows2 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <div class="footer">
                                         <hr />
                                         <div class="stats">
                                             <i class="ti-reload"></i> Updated now
                                         </div>
                                     </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-alert"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>UNSIGNED</p>
                                                <?php echo $number_of_rows3 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Items Statistics</h4>
                                <p class="category">Items percentge</p>
                            </div>
                            <div class="content">
                                <!-- <div class="chartWrap">
                                    <div id="onFeedChart"></div>
                                </div> -->
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Items Per Day
                                        <i class="fa fa-circle text-warning"></i> unsigned Items
                                        <i class="fa fa-circle text-danger"></i> signed Items
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Data fetched 1 hours ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-target"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Parts Awaited Totals</p>
                                                <?php echo $number_of_rows4 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-harddrive"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Parts Awaited Daily</p>
                                                <?php echo $number_of_rows5 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Parts Awaited signed</p>
                                                <?php echo $number_of_rows6 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-alert"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Parts Awaited Unsigned</p>
                                                <?php echo $number_of_rows7 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>


</body>

<!--   Core JS Files   -->
<!-- <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/js/datatables.min.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#table_view').dataTable({
            "aaData": [
                <?php if(!empty($result)) {
                foreach($result as $row) {
                extract($row);
                ?>

                ["<?php echo $UNIT; ?>", "<?php echo $PARTS_NUM; ?>", "<?php echo $SERIAL_NUM; ?>", "<?php echo $DATE_REV; ?>", "<?php echo $DATE_RM; ?>", "<?php echo $AIR_TYPE; ?>", "<?php echo $AIR_REG; ?>", "<?php echo $POSITION; ?>", "<?php echo $QUANTITY; ?>"],

                <?php }
                }
                ?>
            ],
            "columns": [
                {"title": "Unit"},
                {"title": "Part number"},
                {"title": "Serial number"},
                {"title": "Date recieved"},
                {"title": "Date removed"},
                {"title": "Ac type"},
                {"title": "Ac reg"},
                {"title": "Position"},
                {"title": "Quantity"}
            ]
        });
    });
</script>

<script type="text/javascript">
    $('#table_view')
        .addClass('table table-bordered table-striped');
</script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.min.js'></script>
<script src='https://code.highcharts.com/highcharts.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.js'></script>

<script src="assets/js/index.js"></script>


<!-- this is the script that welcomes the user into the page after login-->

<script type="text/javascript">
    $(document).ready(function () {

        // demo.initChartist();
        // initChartist: function(){

        var dataSales = {
            labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
            series: [
                [287, 385, 490, 562, 594, 626, 698, 895, 952],
                [67, 152, 193, 240, 387, 435, 535, 642, 744],
                [23, 113, 67, 108, 190, 239, 307, 410, 410]
            ]
        };

        var optionsSales = {
            lineSmooth: false,
            low: 0,
            high: 1000,
            showArea: true,
            height: "245px",
            axisX: {
                showGrid: false,
            },
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 3
            }),
            showLine: true,
            showPoint: false,
        };

        var responsiveSales = [
            ['screen and (max-width: 640px)', {
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);


        var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [542, 543, 520, 680, 653, 753, 326, 434, 568, 610, 756, 895],
                [230, 293, 380, 480, 503, 553, 600, 664, 698, 710, 736, 795]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartActivity', data, options, responsiveOptions);

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
            <?php
            $totals = $number_of_rows1 + $number_of_rows2 + $number_of_rows3;
            $number_1 = round(($number_of_rows1 / $totals) * 100);
            $number_2 = round(($number_of_rows2 / $totals) * 100);
            $number_3 = round(($number_of_rows3 / $totals) * 100);

            ?>
            labels: [<?php echo $number_1;?>,<?php echo $number_2; ?>,<?php echo $number_3; ?>],
            series: [<?php echo $number_of_rows1; ?>,<?php echo $number_of_rows2; ?>, <?php echo $number_of_rows3; ?>]
        });
        // } ,


        // $.notify({
        //              icon: 'ti-panel',
        //              message: "DASHBOARD"

        //    }  ,


        //    {
        //        type: 'success',
        //        timer: 4000
        //    });

    });
</script> <!-- this is the end of the script that welcomes the user into the login page-->

</html>
