<?php
include_once 'db.php';
?>
<?php
session_start();
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
   ?>
<?php 
date_default_timezone_set("Africa/Nairobi"); 
?> 
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" /> 
    
    <script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->

    <title>KQ Workshop Tracker.</title>

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


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

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
                     Workshop
                </a>
            </div>

           <ul class="nav">
                <li>
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
        
                 <li >
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
                <li >
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
                <li >
                    <a href="parts_awaited.php">
                        <i class="ti-settings"></i>
                        <p>Parts Awaited</p>
                    </a>
                </li>
                <li class="active" >
                   <a href="report.php">
                       <i class="ti-stats-up"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li >
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
                    <a class="navbar-brand" href="#">REPORTS</a>
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
                            <i class="ti-user">&nbsp</i>
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
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">FILTER REPORT BY:</h4>
                            </div>
                            <div class="content">
                                <form name="frmAdd" action="displayreports.php" method="GET">
                                   
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>CATEGORY</label>
                                                    <?php   
                                                        $pdo_statement = $DB_con->prepare("SELECT CATEGORY FROM t_categories_warranty");
                                                        $pdo_statement->execute();
                                                        $result = $pdo_statement->fetchAll();
                                                    ?>

                                                                                               
                                                  <select name="category" id="category" title="department" class="form-control border-input demo-form-field" placeholder="CATEGORY" required="required">
                                                        <option value="">Select Category</option>
                                                <?php foreach ($result as $row): ?>
                                                    <option><?=$row["CATEGORY"]?></option>
                                                <?php endforeach ?>
                                                </select>
                                                  
                                            </div>

                                        </div>



                                        <div class="col-md-4">
                                             <div class="form-group">
                                                  <label>AIRCRAFT REGISTRATION NUMBER</label>
                                                    <?php   
                                                        $pdo_statement = $DB_con->prepare("SELECT REGNUM FROM t_airregnum_warranty");
                                                        $pdo_statement->execute();
                                                        $result = $pdo_statement->fetchAll();
                                                    ?>

                                                                                                   
                                                      <select name="air_reg" id="category" title="department" class="form-control border-input demo-form-field" placeholder="AIRCRAFT REGISTRATION" >
                                                        <option value="">Select A Reg No</option>
                                                    <?php foreach ($result as $row): ?>
                                                        <option><?=$row["REGNUM"]?></option>
                                                    <?php endforeach ?>
                                                    </select>
              
                                            </div>
                                        </div>




                                        <!-- THis is the section for aircraft type -->
                                           <div class="col-md-4">
                                             <div class="form-group">
                                                                                                <label>AIRCRAFT TYPE</label>
                                                                                                <?php   
                                                    $pdo_statement = $DB_con->prepare("SELECT TYPE FROM t_aircrafts_warranty");
                                                    $pdo_statement->execute();
                                                    $result = $pdo_statement->fetchAll();
                                                ?>

                                                                                               
                                                  <select name="air_type" id="air_type" title="department" class="form-control border-input demo-form-field" placeholder="AIRCRAFT TYPE" >
                                                    <option value="">Select Aircraft</option>
                                                <?php foreach ($result as $row): ?>
                                                    <option><?=$row["TYPE"]?></option>
                                                <?php endforeach ?>
                                                </select>
  
                                            </div>
                                        </div> 
                                       
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PART NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="partnumber" placeholder="PART NUMBER" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                                <div class="form-group">
                                                <label>FROM</label>
                                               <!-- <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="REQUISITION DATE">  -->
                                               <input type="date" class="form-control border-input demo-form-field" name="date1" placeholder="DATE RECEIVED" required="required">
                                                </div>
                                         </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>TO</label>
                                               <input type="date" class="form-control border-input demo-form-field" name="date2" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>



                                    </div>

                                   <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="text-center">
                                                <button  type="submit" name="search_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit">VIEW REPORTS</button>
                                            </div>
                                    
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
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


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
   <!--  <script src="assets/js/bootstrap-notify.js"></script> -->

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    <script type="text/javascript">
     $('.datepicker').datepicker({
         weekStart:1,
         color: 'red'
     });
    </script>


</html>
