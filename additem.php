<?php
if(!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO ITEMS ( INSPECNO, WORKORDER, UNIT, PARTNUMBER, SERIALNUMBER, DATERCD, DATERMVD, ACTYPE, ACREG, POS, HOURSRUN, QTY, DEFECT, INSPECNO_OLD, WORKDONE, TECH, DATECOMPLETED, AUTHORITY, SENTTO, DELETED, LASTUSERUPDATE, LASTDATEUPDATE, LASTACTIONUPDATE, SCRAPPED, SECTOR, CATEGORY, BLR, DEACTIVATEREASON, QUARANTINE, MODSTATUS, MANHOURS) VALUES ( :inspecno, :workorder, :unit, :partnumber, :serialnumber, :datercd, :datermvd, :actype, :acreg, :pos, :hoursrun, :qty, :defect, :inspecno_old, :workdone, :tech, :datecompleted, :authority, :sentto, :deleted, :lastuserupdate, :lastdateupdate, :lastactionupdate, :scrapped, :sector, :category, :blr, :deactivatereason, :quarantine, :modstatus, :manhours)";
    $pdo_DATECOMPLETEDment = $DB_con->prepare( $sql );
        
    $result = $pdo_DATECOMPLETEDment->execute( array( ':inspecno'=>$_POST['inspecno'], ':workorder'=>$_POST['workorder'], ':unit'=>$_POST['unit'], ':partnumber'=>$_POST['partnumber'], ':serialnumber'=>$_POST['serialnumber'], ':datercd'=>$_POST['datercd'], ':datermvd'=>$_POST['datermvd'], 'actype'=>$_POST['actype'], ':acreg'=>$_POST['acreg'], ':pos'=>$_POST['pos'], ':hoursrun'=>$_POST['hoursrun'], ':qty'=>$_POST['qty'], ':defect'=>$_POST['defect'], ':inspecno_old'=>$_POST['inspecno_old'], ':workdone'=>$_POST['workdone'], ':tech'=>$_POST['tech'], ':datecompleted'=>$_POST['datecompleted'], ':authority'=>$_POST['authority'], ':sentto'=>$_POST['sentto'], ':deleted'=>$_POST['deleted'], ':lastuserupdate'=>$_POST['lastuserupdate'], ':lastdateupdate'=>$_POST['lastdateupdate'], ':lastactionupdate'=>$_POST['lastactionupdate'], ':scrapped'=>$_POST['scrapped'], ':sector'=>$_POST['sector'], ':category'=>$_POST['category'], ':blr'=>$_POST['blr'], ':deactivatereason'=>$_POST['deactivatereason'], ':quarantine'=>$_POST['quarantine'], ':modstatus'=>$_POST['modstatus'], ':manhours'=>$_POST['manhours'] ) );
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
    // $q1 = 'SELECT * FROM tbl_users WHERE username=:username ';
    //     $query1 = $DB_con->prepare($q1);
    //     $query1->execute(array(':username' => $_SESSION['sess_username']));
    //     $row = $query1->fetch(PDO::FETCH_ASSOC);
    //     extract($row);

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
                    <a href="UNIT.php">
                        <i class="ti-bag"></i>
                        <p>Add UNIT</p>
                    </a>
                </li>
                <li >
                    <a href="WORKDONE.php">
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
                                                <label>UNIT</label>
                                                <?php   
    $pdo_DATECOMPLETEDment = $DB_con->prepare("SELECT UNITS FROM UNITs");
    $pdo_DATECOMPLETEDment->execute();
    $result = $pdo_DATECOMPLETEDment->fetchAll();
?>

                                               <select name="unit" id="UNIT" title="department" class="form-control border-input demo-form-field" placeholder="UNIT" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["UNITS"]?></option>
<?php endforeach ?>
</select> 

                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PARTS NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="partnumber" placeholder="PARTS NUMBER" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>SERIAL NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="serialnumber" placeholder="SERIAL NUMBER" required="required">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE RECEIVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" name="datercd" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE REMOVED</label>
                                                <input type="date" class="form-control border-input demo-form-field" name="datermvd" placeholder="DATE REMOVED" required="required">
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

                                               
  <select id="INSPECNO" title="department" class="form-control border-input demo-form-field" name="actype" id="DATECOMPLETED" placeholder="AIRCRAFT TYPE" required="required">
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

                                               
  <select id="INSPECNO" title="department" class="form-control border-input demo-form-field" name="acreg" id="DATECOMPLETED" placeholder="AIRCRAFT REGISTRATION NUMBER" required="required">
<?php foreach ($result as $row): ?>
    <option><?=$row["REGNUM"]?></option>
<?php endforeach ?>
</select>
  
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="pos" placeholder="POSITION" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>HOURS RUN</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="hoursrun" placeholder="HOURS RUN" required="required">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUATITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="qty" placeholder="QUATITY" required="number">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DEFECT</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="defect" placeholder="DEFECT" required="required">
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

                                               
  <select name="category" id="category" title="department" class="form-control border-input demo-form-field" id="DATECOMPLETED" placeholder="CATEGORY" required="required">
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
                                               
  <select title="department" class="form-control border-input demo-form-field" name="blr" id="DATECOMPLETED" placeholder="BEYOND LOCAL REPAIR" required="required">
                                            <option >Select below</option>
                                            <option value="reparable">reparable</option>
                                            <option value="beyond repair">beyond repair</option>
                                            
                                        </select>
  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUARANTINE POSITION</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="quarantine" placeholder="QUARANTINE POSITION" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MODIFICATION STATUS</label>
                                                <input type="text" class="form-control border-input demo-form-field datepicke" name="modstatus" placeholder="MODIFICATION STATUS" required="required">
                                            </div>
                                        </div>
                                     
                                        </div>





                                        <div class="row">
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>INSPECTION NUMBER</label> -->
                                                <input  type="hidden" class="form-control border-input demo-form-field" name='inspecno' placeholder="INSPECTION NUMBER" required="required"> </div>
                                       <!--  </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>wORK ORDER NUMBER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name='workorder' placeholder="WORK ORDER NUMBER" required="required"> </div>
                                        <!-- </div> -->
                                       <!--  <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>AUTHORITY</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="authority" placeholder="DATE REMOVED" required="required">
                                            </div>
                                       <!--  </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>SENTTO</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="sentto" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DELETED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="deleted" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->


                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>LASTUSERUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastuserupdate" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>LASTDATEUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastdateupdate" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>LASTACTIONUPDATE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="lastactionupdate" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>SCRAPPED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="scrapped" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>SECTOR</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="sector" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        </div>
                                        
                                        <div class="row">

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>INSPECTNUM_OLD</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name="inspecno_old" placeholder="DEFECT" required="required">
                                            </div>
                                      <!--   </div> -->

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>WORKDONE</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name="workdone" placeholder="DEFECT" required="required">
                                            </div>
                                     <!--    </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DEACTIVATIONREASON</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="deactivatereason" placeholder="DATE REMOVED" required="required">
                                            </div>
                                       <!--  </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                               <!--  <label>TECHNICIAN</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" name="tech" value="<?php echo $_SESSION['displayname']; ?>" placeholder="DEFECT" required="required" readonly>
                                            </div>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                        </div>

                                        <div class="row">

                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>DATE COMPLETED</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="datecompleted" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="col-md-4"> -->
                                            <div class="form-group">
                                                <!-- <label>MANHOURS</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field datepicke" name="manhours" placeholder="DATE REMOVED" required="required">
                                            </div>
                                        <!-- </div> -->
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" name="add_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit" >ADD ITEM</button>
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
