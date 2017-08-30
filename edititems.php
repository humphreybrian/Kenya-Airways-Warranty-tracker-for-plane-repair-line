<?php
require_once("db.php");
if(!empty($_POST["save_record"])) {
	$pdo_statement=$pdo_conn->prepare("update items set category='" . $_POST[ 'category' ] . "',  repair_ord_num='" . $_POST[ 'repair_ord_num' ]. "',  unit='" . $_POST[ 'unit' ]. "',  parts_num='" . $_POST[ 'parts_num' ]. "',  serial_num='" . $_POST[ 'serial_num' ]. "',  date_rev='" . $_POST[ 'date_rev' ]. "',  date_rm='" . $_POST[ 'date_rm' ]. "',  air_type='" . $_POST[ 'air_type' ]. "',  air_reg='" . $_POST[ 'air_reg' ]. "', position='" . $_POST[ 'position' ]. "',  hours_run='" . $_POST[ 'hours_run' ]. "',  quantity='" . $_POST[ 'quantity' ]. "',  defect='" . $_POST[ 'defect' ]. "',  mod_status='" . $_POST[ 'mod_status' ]. "',  parts_awaited='" . $_POST[ 'parts_awaited' ]. "',  quant_pos='" . $_POST[ 'quant_pos' ]. "',  state='" . $_POST[ 'state' ]. "'  where id=" . $_GET["id"]);
	$result = $pdo_statement->execute();
	if($result) {
		header('location:table.php');
	}
}
$pdo_statement = $DB_con->prepare("SELECT * FROM items where id=" . $_GET["id"]"");
$pdo_statement->execute();
$result1 = $pdo_statement->fetchAll();
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
               <a href="#" class="simple-text"><img src="assets/img/kqicon.png" height="30px" width="30px" />
                     Tracker
                </a>
            </div>

           
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
                    <a class="navbar-brand" href="#">EDIT ITEMS</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
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

                                               
  <select name="category"  class="form-control border-input demo-form-field" value="<?php echo $result[0]['CATEGORY']; ?>" id="state" placeholder="CATEGORY" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["CATEGORY"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REPAIR ORDER NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field"  value="<?php echo $result1[0]['REPAIR_ORD_NUM']; ?>" name='repair_ord_num' placeholder="REPAIR ORDER NUMBER" required="required"> 
                                                  

                                                 </div>
                                        </div>
                                        <!-- this point its a dropdown thing-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>UNIT</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="unit" value="<?php echo $result1[0]['UNIT']; ?>" placeholder="UNIT" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="parts_num" value="<?php echo $result1[0]['PARTS_NUM']; ?>" placeholder="PARTS NUMBER" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>SERIAL NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="serial_num" value="<?php echo $result1[0]['SERIAL_NUM']; ?>" placeholder="SERIAL NUMBER" required="required">
                                            </div>
                                        </div>
                                        <!-- select the exact date-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE RECIEVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" name="date_rev" value="<?php echo $result1[0]['DATE_REV']; ?>" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <!-- select the exact date-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE REMOVED</label>
                                                <input type="date" class="form-control border-input demo-form-field datepicke" name="date_rm" value="<?php echo $result1[0]['DATE_RM']; ?>" placeholder="DATE REMOVED" required="required">
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

                                               
  <select name="air_type"  class="form-control border-input demo-form-field"  value="<?php echo $result[0]['AIR_TYPE']; ?>"  placeholder="AIRCRAFT TYPE" required="required">
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

                                               
  <select name="air_reg" value="<?php echo $result[0]['AIR_REG']; ?>"  class="form-control border-input demo-form-field"  placeholder="AIRCRAFT TYPE" required="required">
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
                                                <input type="text" class="form-control border-input demo-form-field" name="position" value="<?php echo $result1[0]['POSITION']; ?>" placeholder="POSITION" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>HOURS RUN</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="hours_run" value="<?php echo $result1[0]['HOURS_RUN']; ?>" placeholder="HOURS RUN" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="quantity" value="<?php echo $result1[0]['QUANTITY']; ?>" placeholder="QUANTITY" required="number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DEFECT</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="defect" value="<?php echo $result1[0]['DEFECT']; ?>" placeholder="DEFECT" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MODIFICATION STATUS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="mod_status" value="<?php echo $result1[0]['MOD_STATUS']; ?>" placeholder="MODIFICATION STATUS" required="required" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS AWAITED</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="parts_awaited" value="<?php echo $result1[0]['PARTS_AWAITED']; ?>" placeholder="PARTS AWAITED" required="required">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUARANTINE POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="quant_pos" value="<?php echo $result1[0]['QUANT_POS']; ?>" placeholder="QUARANTINE POSITION" required="required">
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
                                               
  <select title="department" class="form-control border-input demo-form-field" name="state" value="<?php echo $result1[0]['STATE']; ?>" id="state" placeholder="MODIFICATION STATUS" required="required">
                                            <option >Select below</option>
                                            <option value="reparable">reparable</option>
                                            <option value="beyond repair">beyond repair</option>
                                            
                                        </select>
  
                                            </div>
                                        </div>
                                       <!--  <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS AWAITED</label>
                                                <input type="number" class="form-control border-input demo-form-field" placeholder="PARTS AWAITED">
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="add_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit" >EDIT ITEM</button>
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