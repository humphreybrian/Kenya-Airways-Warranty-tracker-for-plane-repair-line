<?php
require_once("db.php");
if(!empty($_POST["save_record"])) {
	$pdo_statement=$DB_con->prepare("update items set inspecno='" . $_POST[ 'inspecno' ] . "',  workorder='" . $_POST[ 'workorder' ]. "',  unit='" . $_POST[ 'unit' ]. "',  partnumber='" . $_POST[ 'partnumber' ]. "',  serialnumber='" . $_POST[ 'serialnumber' ]. "',  datercd='" . $_POST[ 'datercd' ]. "',  datermvd='" . $_POST[ 'datermvd' ]. "',  actype='" . $_POST[ 'actype' ]. "',  acreg='" . $_POST[ 'acreg' ]. "', pos='" . $_POST[ 'pos' ]. "',  hoursrun='" . $_POST[ 'hoursrun' ]. "',  qty='" . $_POST[ 'qty' ]. "',  defect='" . $_POST[ 'defect' ]. "',  inspecno_old='" . $_POST[ 'inspecno_old' ]. "',  workdone='" . $_POST[ 'workdone' ]. "',  tech='" . $_POST[ 'tech' ]. "',  datecompleted='" . $_POST[ 'datecompleted' ]. "', authority='" . $_POST[ 'authority' ]. "', sentto='" . $_POST[ 'sentto' ]. "', deleted='" . $_POST[ 'deleted' ]. "', lastuserupdate='" . $_POST[ 'lastuserupdate' ]. "', lastdateupdate='" . $_POST[ 'lastdateupdate' ]. "', lastactionupdate='" . $_POST[ 'lastactionupdate' ]. "', scrapped='" . $_POST[ 'scrapped' ]. "', sector='" . $_POST[ 'sector' ]. "', category='" . $_POST[ 'category' ]. "', blr='" . $_POST[ 'blr' ]. "', deactivatereason='" . $_POST[ 'deactivatereason' ]. "', quarantine='" . $_POST[ 'quarantine' ]. "', modstatus='" . $_POST[ 'modstatus' ]. "', manhours='" . $_POST[ 'manhours' ]. "'  where id=" . $_GET["id"]);
	$result = $pdo_statement->execute();
	if($result) {
		header('location:table.php');
	}
}
$pdo_statement = $DB_con->prepare("SELECT * FROM items where id='$_GET[id]'");
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
                     Workshop
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
                                <h4 class="title">EDIT ITEM</h4>
                            </div>
                            <div class="content">
                                 <form name="frmAdd" action="" method="POST">

                                   

                                    <div class="row">
                                       

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>UNIT</label>
                                                <?php   
    $pdo_DATECOMPLETEDment = $DB_con->prepare("SELECT UNITS FROM UNITs");
    $pdo_DATECOMPLETEDment->execute();
    $result = $pdo_DATECOMPLETEDment->fetchAll();
?>

                                               <select name="unit" id="UNIT" title="department" value="<?php echo $result[0]['UNITS']; ?>" class="form-control border-input demo-form-field" placeholder="UNIT" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["UNITS"]?></option>
<?php endforeach ?>
</select> 

                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" value="<?php echo $result1[0]['PARTNUMBER']; ?>" name="partnumber" placeholder="PARTS NUMBER" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>SERIAL NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="serialnumber" value="<?php echo $result1[0]['SERIALNUMBER']; ?>" placeholder="SERIAL NUMBER" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE RECEIVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" name="datercd" value="<?php echo $result1[0]['DATERCD']; ?>" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE REMOVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" value="<?php echo $result1[0]['DATERMVD']; ?>" name="datermvd" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AIRCRAFT TYPE</label>
                                                <?php   
    $pdo_DATECOMPLETEDment = $DB_con->prepare("SELECT TYPE FROM aircrafts");
    $pdo_DATECOMPLETEDment->execute();
    $result = $pdo_DATECOMPLETEDment->fetchAll();
?>

                                               
  <select  title="department" class="form-control border-input demo-form-field" name="actype" value="<?php echo $result1[0]['ACTYPE']; ?>" id="DATECOMPLETED" placeholder="AIRCRAFT TYPE" required="required">
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
                                                <label>AIRCRAFT REGISTRATION NUMBER</label>
                                                <?php   
    $pdo_DATECOMPLETEDment = $DB_con->prepare("SELECT REGNUM FROM airregnum");
    $pdo_DATECOMPLETEDment->execute();
    $result = $pdo_DATECOMPLETEDment->fetchAll();
?>

                                               
  <select id="INSPECNO" title="department" class="form-control border-input demo-form-field" name="acreg" value="<?php echo $result1[0]['ACREG']; ?>" id="DATECOMPLETED" placeholder="AIRCRAFT REGISTRATION NUMBER" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["REGNUM"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="pos" value="<?php echo $result1[0]['POS']; ?>" placeholder="POSITION" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>HOURS RUN</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="hoursrun" value="<?php echo $result1[0]['HOURSRUN']; ?>" placeholder="HOURS RUN" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUATITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="qty" value="<?php echo $result1[0]['QTY']; ?>" placeholder="QUATITY" required="number">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DEFECT</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="defect" value="<?php echo $result1[0]['DEFECT']; ?>" placeholder="DEFECT" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CATEGORY</label>
                                                <?php   
    $pdo_DATECOMPLETEDment = $DB_con->prepare("SELECT CATEGORY FROM categories");
    $pdo_DATECOMPLETEDment->execute();
    $result = $pdo_DATECOMPLETEDment->fetchAll();
    ?>

                                               
  <select name="category" value="<?php echo $result1[0]['CATEGORY']; ?>" id="category" title="department" class="form-control border-input demo-form-field" id="DATECOMPLETED" placeholder="CATEGORY" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["CATEGORY"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>BEYOND LOCAL REPAIR</label>
                                               
  <select title="department" class="form-control border-input demo-form-field" name="blr" value="<?php echo $result1[0]['BLR']; ?>" id="DATECOMPLETED" placeholder="BEYOND LOCAL REPAIR" required="required">
                                            <option >Select below</option>
                                            <option value="reparable">reparable</option>
                                            <option value="beyond repair">beyond repair</option>
                                            
                                        </select>
  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUARANTINE POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="quarantine" value="<?php echo $result1[0]['QUARANTINE']; ?>" placeholder="QUARANTINE POSITION" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MODIFICATION STATUS</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="modstatus" value="<?php echo $result1[0]['MODSTATUS']; ?>" placeholder="MODIFICATION STATUS" required="required">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INSPECTION NUMBER</label>
                                                <input  type="text" class="form-control border-input demo-form-field" name='inspecno' value="<?php echo $result1[0]['INSPECNO']; ?>" placeholder="INSPECTION NUMBER" required="required"> </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>WORK ORDER NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name='workorder' value="<?php echo $result1[0]['WORKORDER']; ?>" placeholder="WORK ORDER NUMBER" required="required"> </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AUTHORITY</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="authority" value="<?php echo $result1[0]['AUTHORITY']; ?>" placeholder="AUTHORITY" required="required">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>SENTTO</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="sentto" value="<?php echo $result1[0]['SENTTO']; ?>" placeholder="SENTTO" required="required">
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>WORKDONE</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="workdone" value="<?php echo $result1[0]['WORKDONE']; ?>" placeholder="WORKDONE" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE COMPLETED</label>
                                                <input type="date" class="form-control border-input demo-form-field datepicke" name="datecompleted" value="<?php echo $result1[0]['DATECOMPLETED']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DELETED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="deleted" value="<?php echo $result1[0]['DELETED']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->


                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>LASTUSERUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastuserupdate" value="<?php echo $result1[0]['LASTUSERUPDATE']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>LASTDATEUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastdateupdate" value="<?php echo $result1[0]['LASTDATEUPDATE']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>LASTACTIONUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastactionupdate" value="<?php echo $result1[0]['LASTACTIONUPDATE']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>SCRAPPED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="scrapped" value="<?php echo $result1[0]['SCRAPPED']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>SECTOR</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="sector" value="<?php echo $result1[0]['SECTOR']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>INSPECTNUM_OLD</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name="inspecno_old" value="<?php echo $result1[0]['INSPECNO_OLD']; ?>" placeholder="DEFECT" required="required">
                                            </div>
                                      <!--   </div> -->

                                       

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DEACTIVATIONREASON</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="deactivatereason" value="<?php echo $result1[0]['DEACTIVATEREASON']; ?>" placeholder="DATE REMOVED" required="required">
                                            </div>
                                       <!--  </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>TECHNICIAN</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name="tech" value="<?php echo $result1[0]['TECH']; ?>" value="<?php echo $_SESSION['displayname']; ?>" placeholder="DEFECT" required="required" readonly>
                                            </div>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                       

                                        

                                         </div>


                                        <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MANHOURS</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="manhours" value="<?php echo $result1[0]['MANHOURS']; ?>" placeholder="MANHOURS" required="required">
                                            </div>
                                        </div>

                                        </div>

                                    <div class="text-center">
                                        <button type="submit" name="save_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit" >EDIT ITEM</button>
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