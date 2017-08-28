<?php

include_once 'db.php';
?>
<?php

require_once('db.php');

?>
<?php
session_start();
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->

	<title>KQ Tracker System.</title>

	<!-- <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" /> -->


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

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
               <a href="#" class="simple-text"><img src="assets/img/kqicon.png" height="30px" width="30px" />
                     Tracker
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
                        <i class="ti-user"></i>
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
                        <i class="ti-text"></i>
                        <p>AddItem</p>
                    </a>
                </li>
                <li>
                    <a href="addaircraft.php">
                        <i class="ti-pencil-alt2"></i>
                        <p>Aircraft Type</p>
                    </a>
                </li>
                <li>
                    <a href="aircraftregnum.php">
                        <i class="ti-map"></i>
                        <p>Aircraft Reg Number</p>
                    </a>
                </li>
               <li>
                    <a href="unit.php">
                        <i class="ti-bell"></i>
                        <p>Add Unit</p>
                    </a>
                </li>
                <li>
                    <a href="parts_awaited.php">
                        <i class="ti-bell"></i>
                        <p>Parts Awaited</p>
                    </a>
                </li>
				<li >
                    <a href="report.php">
                       <i class="ti-pie-chart"></i>
                        <p>Reports</p>
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
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ITEMS </h4>
                                <!-- <p class="category">24 Hours performance</p> -->
                            </div>
                            <?php   
    $pdo_statement = $DB_con->prepare("SELECT * FROM items ORDER BY id ASC");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>
                          <!--   <div class="content"> -->
                           
                            <div class="container">
                                 <table id="table_view"></table>
                            </div>  

                     
                                
                            <!-- </div> -->
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
    $(document).ready(function() 
    {
     $('#table_view').dataTable( {
            "aaData": [
    <?php if(!empty($result)) { 
                foreach($result as $row) {
                 extract($row);
        ?>

       ["<?php echo $ID; ?>","<?php echo $UNIT; ?>","<?php echo $PARTS_NUM; ?>","<?php echo $SERIAL_NUM; ?>","<?php echo $DATE_REV; ?>","<?php echo $DATE_RM; ?>","<?php echo $AIR_TYPE; ?>","<?php echo $AIR_REG; ?>","<?php echo $POSITION; ?>","<?php echo $QUANTITY; ?>"],
       
    <?php }
            }
        ?>
       ],
            "columns": [
                { "title": "ID" },
                { "title": "UNIT" },
                { "title": "PART NUMBER" },
                { "title": "SERIAL NUMBER" },
                { "title": "DATE RECIEVED" },
                { "title": "DATE REMOVED" },
                { "title": "AC TYPE" },
                { "title": "AC REG" },
                { "title": "POSITION" },
                { "title": "QUANTITY" }
            ]
        } );   
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




    <!-- this is the script that welcomes the user into the page after login-->

	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script> --> <!-- this is the end of the script that welcomes the user into the login page-->

</html>
