<?php
session_start();
include 'db.php';
if (!isset($_SESSION['sess_username'])) {
    header('Location: login.php?err=2');
}

$q1 = 'SELECT * FROM users WHERE name=:username ';
$query1 = $DB_con->prepare($q1);
$query1->execute(array(':username' => $_SESSION['sess_username']));
$row = $query1->fetch(PDO::FETCH_ASSOC);
extract($row);
include 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KQ Flight Operations</title>

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="home">

                    <img src="img/logo.png" alt="kq logo" width="130">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php
                    if (!isset($_SESSION['sess_username'])) { ?>
                        <li><a href="login">Login</a></li>
                        <li><a href="register">Register</a></li>
                    <?php } else { ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <?php echo $NAME ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="logout"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="logout" method="POST" style="display: none;">

                                    </form>
                                </li>
                            </ul>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="" id="page">

        <div class="col-md-12">
            <div class="col-md-2">
                <form method="get" action="">

                    <select name="title" id="state" value="" class="form-control">
                        <option value="NRD">NRB</option>

                    </select>
                </form>
            </div>
            <div class="col-md-5">
                <div class="col-md-6">
                    <span class="glyphicon glyphicon-time"><span>Earliest: 6:35</span></span>
                </div>
                <div class="col-md-6">
                    <span class="glyphicon glyphicon-time"><span>Latest: 23:55</span></span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-md-7">
                    <div class="form-group">
                        <form method="get" action="">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="date" id="stat" class="form-control " value=""/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </span>

                            </div>
                            <button class="btn btn-default-sm pull-right" type="submit">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 text-center text-primary">
                    <h2>  <?php echo date('H:i'); ?></h2>
                </div>
            </div>
        </div>
        <hr>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <!-- start body -->
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="progress col-md-10 col-md-offset-1">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                     aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div>
                                <span class="pull-left">8:00</span>
                                <span class="col-md-6 bg-primary col-md-offset-3">23:00~4:00 No of Flights 50</span>
                                <span class="pull-right">8:00 + 1</span>
                            </div>
                            <br>
                            <div class="clearfix"></div>
                            <!--    {{ Outbound flights }} -->
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="h4 ">Outbound Flights</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-1 well">
                                        <span class="glyphicon glyphicon-plane"></span>
                                    </div>
                                    <div class="col-md-11 text-center">
                                        <div class="col-md-3">
                                            <p>Flights</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Departed/Planned</p>
                                            <p>545/555</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Current Delayed/Total Delayed</p>
                                            <p>5/13</p>
                                        </div>
                                        <div class="progress col-md-11">
                                            <div class="progress-bar" role="progressbar"
                                                 aria-valuenow="{{$outboundPercentage}}" aria-valuemin="0"
                                                 aria-valuemax="100" style="width:60%">
                                                <span class="sr-only">65% Complete</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Departed Pax</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Remaining Pax</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Total Pax</p>
                                            <p>555</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Inbound flights  -->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="h4 ">Inbound Flights</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-1 well">
                                        <span class="glyphicon glyphicon-plane"></span>
                                    </div>
                                    <div class="col-md-11 text-center">
                                        <div class="col-md-3">
                                            <p>Flights</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Departed/Planned</p>
                                            <p>555/6669</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Current Delayed/Total Delayed</p>
                                            <p>5/13</p>
                                        </div>
                                        <div class="progress col-md-11">
                                            <div class="progress-bar" role="progressbar"
                                                 aria-valuenow="{{$inboundPercentage}}" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 60%;">
                                                <span class="sr-only">68% Complete</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Departed Pax</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Remaining Pax</p>
                                            <p>555</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Total Pax</p>
                                            <p>555</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-7">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        Diverted
                                    </div>
                                    <div class="panel-body">
                                        <p><span>Diverted Into </span> <span class="pull-right"> 5</span></p>
                                        <p><span>Diverted Out of </span> <span class="pull-right"> 5</span></p>
                                        <p><span>AOG </span> <span class="pull-right"> 5</span></p>
                                    </div>
                                </div>

                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        Delayed Flights
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6 panel panel-default">
                                            <p><span>1-15Min </span> <span class="pull-right"> 555</span></p>
                                            <p><span>15-30Min </span> <span class="pull-right"> 55</span></p>
                                        </div>
                                        <div class="col-md-6 panel panel-default">
                                            <p><span>30-60Min </span> <span class="pull-right"> 55</span></p>
                                            <p><span>>1Hr </span> <span class="pull-right"> 555</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="text-center" id="circle">
                                        <p>CF</p>
                                        <p>80%</p>
                                    </div>
                                    <div class="clearfix"><br><br><br></div>
                                    <div class="text-center center-block" id="circle">
                                        <p>CF</p>
                                        <p>80%</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Delayed arrivals  -->
                            <div class="col-md-8">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        Delayed Arrivals
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <p class="panel panel-default"><span> < 15 Mins</span> <span
                                                        class="pull-right"> 66</span></p>
                                            <p class="panel panel-default"><span> >15 Mins </span> <span
                                                        class="pull-right"> 55</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- on time departures  -->
                            <div class="col-md-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        On Time Departures
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <p class="panel panel-default"><span>Total Departures </span> <span
                                                        class="pull-right">  545</span></p>
                                            <p class="panel panel-default"><span>On Time </span> <span
                                                        class="pull-right"> 32</span></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        Departmental Delays(Flights/Minutes)
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <p class="panel panel-default"><span>GND </span> <span class="pull-right"> 15/34</span>
                                            </p>
                                            <p class="panel panel-default"><span>COO </span> <span class="pull-right"> 5/23</span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="panel panel-default"><span>FOP</span> <span class="pull-right"> 12/300</span>
                                            </p>
                                            <p class="panel panel-default"><span>>TECH </span> <span class="pull-right"> 5/120</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- on time departures  -->
                            <div class="col-md-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        On Time Arrivals
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <p class="panel panel-default"><span>Total Arivals </span> <span
                                                        class="pull-right"> 34</span></p>
                                            <p class="panel panel-default"><span>On Time </span> <span
                                                        class="pull-right">44</span></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        var bindDatePicker = function () {
            $(".date").datetimepicker({
                format: 'YYYYMMDD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }

            }).find('input:first').on("blur", function () {
                // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                // update the format if it's yyyy-mm-dd
                var date = parseDate($(this).val());

                if (!isValidDate(date)) {
                    //create date based on momentjs (we have that)
                    date = moment().format('YYYYMMDD');
                }

                $(this).val(date);
            });
        }


        var isValidDate = function (value, format) {
            format = format || false;
            // lets parse the date to the best of our knowledge
            if (format) {
                value = parseDate(value);
            }

            var timestamp = Date.parse(value);

            return isNaN(timestamp) == false;
        }

        var parseDate = function (value) {
            var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
            if (m)
                value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

            return value;
        }

        bindDatePicker();
    });
</script>

</body>
</html>