<?php
if(!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO AIRCRAFTS ( TYPE, USERNAME, POSTEDAT ) VALUES ( :type, :username, :postedat )";
    $pdo_statement = $DB_con->prepare( $sql );
        
    $result = $pdo_statement->execute( array( ':type'=>$_POST['type'], ':username'=>$_POST['username'], ':postedat'=>$_POST['postedat'] ) );
    if (!empty($result) ){
      header('location:addaircraft.php');
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
   
?>
<?php 
date_default_timezone_set("Africa/Nairobi"); 
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
        
                 <li >
                    <a href="additem.php">
                        <i class="ti-save-alt"></i>
                        <p>AddItem</p>
                    </a>
                </li>
               <li class="active">
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
                    <a class="navbar-brand" href="#">AIRCRAFT TYPE</a>
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
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ADD AIRCRAFT TYPE</h4>
                            </div>
                            <div class="content">
                                <form name="frmAdd" action="" method="POST">
                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>AIRCRAFT TYPE</label>
                                                <input type="text" name="type" class="form-control border-input demo-form-field"  placeholder="Aircraft type">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <!--  <label>USER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field" value="<?php echo $_SESSION['displayname']; ?>" readonly="" name="username" placeholder="USERNAME">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!-- <label>DATEPOSTED</label> -->
                                                <input type="hidden" value="<?php echo date("d-M-Y"); ?>" class="form-control border-input demo-form-field" name="postedat" placeholder="UNIT">
                                            </div>
                                        </div>
                                        
                                    </div>

                                   
                                    <div class="text-center">
                                        <button type="submit" name="add_record" value="Add" class="btn btn-danger btn-fill btn-wd demo-form-submit"">ADD AIRCRAFT TYPE</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- start of the second card-->

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">MANAGE AIRCRAFT REGISTRATION NUMBER</h4>
                            </div>
                            <div class="content">
                            <table cellpadding="1" class="table table-striped table-bordered" cellspacing="1" id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>
                                     
                                        <th >AIRCARFT TYPE</th>
                                      <!-- <th class="table-header" width="20%">DESCRIPTION</th> -->
                                      <!-- <th class="table-header" width="20%">CATEGORY</th>
                                       <th class="table-header" width="20%">TAG</th> -->
                                      <!-- <th class="table-header" width="20%">STORESCOMMENT</th> -->
                                      <!-- <th >DATEOFENTRY</th> -->
                                      <!-- <th class="table-header" width="20%">DateofEnq</th>
                                      <th class="table-header" width="20%">InspectionNum</th> -->
                                      <th >Actions</th> 
                                    </tr>
                                    </thead>
                                </table>

   
       

                            <!-- this is the place for the content of the table aircraft types-->
                                
                            </div>
                        </div>
                    </div>


                    <!-- end of the secind card-->


                </div>
            </div>
        </div>

      

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" language="javascript" >
            $(document).ready(function() {
                $('#table_data').dataTable( {
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "aircraft_serverside.php",
                    "aoColumns": [
                          { "sName": "TYPE" },
                            // { "sName": "CATEGORY" },
                            // { "sName": "TAG" },
                            // { "sName": "DATERCD" },
                            // { "sName": "DATERMVD" },



                    ],
                     "columnDefs": [
                            { 
                                "targets": 1,
                                "render": function(data, type, row, meta){
                                   return '<a href="editair_type.php?id=' + row[1] + '"><i class="fa fa-pencil" style="color:#DAA520;"></i></a><a class="ajax-action-links"  href="javascript:delete_id('+ row[1] +')" ><i class="fa fa-trash" style="color:red;"></i></a>';  
                                }
                            }            
                        ]        
                } );
            } );
        </script>
        <script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='deleteair_type.php?id='+id;
     }
}
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


</html>
