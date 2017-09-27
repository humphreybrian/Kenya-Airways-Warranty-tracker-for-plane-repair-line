<?php
require_once("db.php");
if(!empty($_POST["save_record"])) {
	$pdo_statement=$DB_con->prepare("update partsawaited set signoff='" . $_POST[ 'validate' ]. "'  where id=" . $_GET["id"]);
	$result = $pdo_statement->execute();
	if($result) {
		header('location:parts_awaited.php?message=1');
	}
}
$pdo_statement = $DB_con->prepare("SELECT * FROM partsawaited where id='$_GET[id]'");
$pdo_statement->execute();
$result1 = $pdo_statement->fetchAll();
?>
<?php 
date_default_timezone_set("Africa/Nairobi");
session_start();
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    } 
?>
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


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="black" data-active-color="danger">

   

    	<div class="sidebar-wrapper">
            <div class="logo">
               <a href="dashboard.php" class="simple-text"><img src="assets/img/kqicon.png" height="30px" width="30px" />
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
                <li >
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
              <li >
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
                <li >
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
                    <a class="navbar-brand" href="#">SIGN OFF</a>
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
                            <a href="#">
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
                   
                    <div class=" col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">SIGN OFF</h4>
                            </div>
                            <div class="content">
                                 <form name="frmAdd" action="" method="POST">

                                   

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" value="<?php echo $result1[0]['SPAREPARTNUMBER']; ?>" name="partnumber" placeholder="PARTS NUMBER" required="required" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUEST NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="serialnumber" value="<?php echo $result1[0]['REQNUMBER']; ?>" placeholder="SERIAL NUMBER" required="required" readonly>
                                            </div>
                                        </div>
                                                                    
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE OF REQUEST</label>
                                                <input class="form-control border-input demo-form-field" value="<?php echo $result1[0]['DATEOFREQ']; ?>" placeholder="DATE RECEIVED" required="required" readonly>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ENGINEER</label>
                                                <input class="form-control border-input demo-form-field" value="<?php echo $result1[0]['ENGINEER']; ?>" placeholder="DATE REMOVED" required="required" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input class="form-control border-input demo-form-field datepicke" value="<?php echo $result1[0]['QUANTITY']; ?>" placeholder="DATE REMOVED" required="required" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REMARKS</label>
                                                <input class="form-control border-input demo-form-field" value="<?php echo $result1[0]['REMARKS']; ?>" value="<?php echo $_SESSION['displayname']; ?>" placeholder="DEFECT" required="required" readonly>
                                            </div>
                                            </div>
                                       </div>


                                        <div class="row">
                                          <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MANHOURS</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="manhours" value="<?php //echo $result1[0]['MANHOURS']; ?>" placeholder="MANHOURS" required="required">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DATE COMPLETED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="validate" value="1" placeholder="VALIDATE" required="required">
                                            </div>
                                        <!-- </div> -->
                                              </div>

                                    <div class="text-center">
                                        <button type="submit" name="save_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit" >SIGN OFF</button>
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


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

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

</html>