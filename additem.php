<?php
if(!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO ITEMS ( CATEGORY, REPAIR_ORD_NUM, UNIT, PARTS_NUM, SERIAL_NUM, DATE_REV, DATE_RM, AIR_TYPE, AIR_REG, POSITION, HOURS_RUN, QUANTITY, DEFECT, MOD_STATUS, PARTS_AWAITED, QUANT_POS, STATE, USERNAME ) VALUES ( :category, :repair_ord_num, :unit, :parts_num, :serial_num, :date_rev, :date_rm, :air_type, :air_reg, :position, :hours_run, :quantity, :defect, :mod_status, :parts_awaited, :quant_pos, :state, :username)";
    $pdo_statement = $DB_con->prepare( $sql );
        
    $result = $pdo_statement->execute( array( ':category'=>$_POST['category'], ':repair_ord_num'=>$_POST['repair_ord_num'], ':unit'=>$_POST['unit'], ':parts_num'=>$_POST['parts_num'], ':serial_num'=>$_POST['serial_num'], ':date_rev'=>$_POST['date_rev'], ':date_rm'=>$_POST['date_rm'], 'air_type'=>$_POST['air_type'], ':air_reg'=>$_POST['air_reg'], ':position'=>$_POST['position'], ':hours_run'=>$_POST['hours_run'], ':quantity'=>$_POST['quantity'], ':defect'=>$_POST['defect'], ':mod_status'=>$_POST['mod_status'], ':parts_awaited'=>$_POST['parts_awaited'], ':quant_pos'=>$_POST['quant_pos'], ':state'=>$_POST['state'], ':username'=>$_POST['username'] ) );
    if (!empty($result) ){
      header('location:table.php');
    }
}
?>
<?php
include_once 'db.php';
?>
<?php
session_start();
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    $q1 = 'SELECT * FROM tbl_users WHERE username=:username ';
        $query1 = $DB_con->prepare($q1);
        $query1->execute(array(':username' => $_SESSION['sess_username']));
        $row = $query1->fetch(PDO::FETCH_ASSOC);
        extract($row);

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
        
                 <li class="active" >
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
                    <a class="navbar-brand" href="#">ADD ITEM</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li> -->
                       <!--  <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li> -->
                        <li>
                            <a href="#">
                            <i class="ti-user">&nbsp</i><p>Hello</p>
                                    <?php echo $USERNAME ?>
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
                
                    
                    <div class=" col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ADD ITEM</h4>
                            </div>
                            <div class="content">
                                 <form name="frmAdd" action="" method="POST">

                                   

                                    <div class="row">
                                       

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CATEGORY</label>
                                                <?php   
    $pdo_statement = $DB_con->prepare("SELECT CATEGORY FROM categories");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                                               
  <select name="category" id="category" title="department" class="form-control border-input demo-form-field" name="state" id="state" placeholder="CATEGORY" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["CATEGORY"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REPAIR ORDER NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name='repair_ord_num' placeholder="REPAIR ORDER NUMBER" required="required"> </div>
                                        </div>


                                        <!-- this point its a dropdown thing-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>UNIT</label>
                                                <?php   
    $pdo_statement = $DB_con->prepare("SELECT UNITS FROM units");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                                               <select name="unit" id="unit" title="department" class="form-control border-input demo-form-field" placeholder="UNIT" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["UNITS"]?></option>
<?php endforeach ?>
</select> 
                                               <!--  <input type="text" class="form-control border-input demo-form-field" name="unit" placeholder="UNIT" required="required"> -->
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="parts_num" placeholder="PARTS NUMBER" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>SERIAL NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="serial_num" placeholder="SERIAL NUMBER" required="required">
                                            </div>
                                        </div>
                                        <!-- select the exact date-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE RECIEVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" name="date_rev" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <!-- select the exact date-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE REMOVED</label>
                                                <input type="date" class="form-control border-input demo-form-field datepicke" name="date_rm" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AIRCRAFT TYPE</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="air_type" placeholder="AIRCRAFT TYPE" required="required">
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AIRCRAFT TYPE</label>
                                                <?php   
    $pdo_statement = $DB_con->prepare("SELECT TYPE FROM aircrafts");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                                               
  <select name="air_type" id="category" title="department" class="form-control border-input demo-form-field" name="state" id="state" placeholder="AIRCRAFT TYPE" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["TYPE"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>
                                       <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AIRCRAFT REGISTRATION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="air_reg" placeholder="AIRCRAFT REGISTRATION NUMBER" required="required">
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AIRCRAFT REGISTRATION NUMBER</label>
                                                <?php   
    $pdo_statement = $DB_con->prepare("SELECT REGNUM FROM airregnum");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                                               
  <select name="air_reg" id="category" title="department" class="form-control border-input demo-form-field" name="state" id="state" placeholder="AIRCRAFT TYPE" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["REGNUM"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="position" placeholder="POSITION" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>HOURS RUN</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="hours_run" placeholder="HOURS RUN" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="quantity" placeholder="QUANTITY" required="number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DEFECT</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="defect" placeholder="DEFECT" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MODIFICATION STATUS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="mod_status" placeholder="MODIFICATION STATUS" required="required" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS AWAITED</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="parts_awaited" placeholder="PARTS AWAITED" required="required">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUARANTINE POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="quant_pos" placeholder="QUARANTINE POSITION" required="required">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ITEM CONDITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="state" placeholder="MODIFICATION STATUS" >
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ITEM CONDITION</label>
                                               
  <select title="department" class="form-control border-input demo-form-field" name="state" id="state" placeholder="MODIFICATION STATUS" required="required">
                                            <option >Select below</option>
                                            <option value="reparable">reparable</option>
                                            <option value="beyond repair">beyond repair</option>
                                            
                                        </select>
  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!-- <label>USER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" value="<?php echo $USERNAME ?>" readonly="" name="username" placeholder="USERNAME">
                                            </div>
                                        </div></div>
                                       <!--  <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS AWAITED</label>
                                                <input type="number" class="form-control border-input demo-form-field" placeholder="PARTS AWAITED">
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="add_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit" >ADD ITEM</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- start of the second card-->

                    

                    <!-- end of the secind card-->


                </div>
            </div>
        </div>

        <!-- <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
				<div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer> -->


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
