<?php
session_start();
    $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) && $role!="admin"){
      header('Location: index.php?err=2');
    }
?>
<?php
if(!empty($_POST["add_record"])) {
    $passhash = md5($_POST['password']);
    require_once("db.php");
    $sql = "INSERT INTO TBL_USERS ( USERNAME, PASSWORD, ROLE ) VALUES ( :username, :password, :role )";
    $pdo_statement = $DB_con->prepare( $sql );
        
    $result = $pdo_statement->execute( array( ':username'=>$_POST['username'], ':password'=>$passhash, ':role'=>$_POST['role']) );
    if (!empty($result) ){
      header('location:manageusers.php');
    }
}
?>
<?php
include_once 'db.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	 <link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>KQ Tracker System.</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


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
                     Tracker
                </a>
            </div>

            <ul class="nav">
               <!--  <li >
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
                <li >
                    <a href="report.php">
                       <i class="ti-pie-chart"></i>
                        <p>Reports</p>
                    </a>
                </li> -->
                <li class="active">
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
                    <a class="navbar-brand" href="#">MANAGE USERS</a>
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
                   
                    <div class=" col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ADD USER </h4>
                            </div>
                            <div class="content">
                               <form name="frmAdd" action="" method="POST">
                                   

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>USER NAME</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="username" placeholder="username">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PASSWORD</label>
                                                <input type="text" value="user1234" class="form-control border-input demo-form-field" name="password" readonly placeholder="password">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ROLE</label>
                                               
  <select title="role" name="role" id="role"  class="form-control" required="required">
                                            <!-- <option >Select below</option> -->
                                            <option value="admin">ADMIN</option>
                                            <option value="user">NORMAL USER</option>
                                            
                                        </select>
  
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit" value="Add" name="add_record">ADD USER</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- start of the second card-->

                    <div class="col-md-12">
                    <div class="card">
                            <div class="header">
                                <h4 class="title">MANAGE CATEGORIES</h4>
                               <!--  <p class="username">Here is a subtitle for this table</p> -->
                            </div>
                            <?php   
    $pdo_statement = $DB_con->prepare("SELECT * FROM tbl_users ORDER BY id ASC");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                            <div class="content table-responsive table-full-width">
                                <div class="container">
     <!-- <table class='table table-bordered table-responsive'> -->
    
<table class="tbl-qa table table table-bordered table-responsive ">
  <thead>
    <tr>

    <th class="table-header" width="20%">ID</th>
      <th class="table-header" width="20%">USER NAME</th>
      <!-- <th class="table-header" width="20%">ROLE</th> -->
      <!-- <th class="table-header" width="20%">role</th> -->
      <!-- <th class="table-header" width="20%">POSITION</th>
      <th class="table-header" width="20%">QUANTITY</th>
      <th class="table-header" width="20%">DEFECT</th>
      <th class="table-header" width="20%">QUANT_POS</th>
      <th class="table-header" width="20%">STATE</th>-->
      <th class="table-header" width="5%">Actions</th> 
    </tr>
  </thead>
  <tbody id="table-body">
    <?php
    if(!empty($result)) { 
        foreach($result as $row) {
    ?>
      <tr class="table-row">
      <td><?php echo $row["ID"]; ?></td>
        <td><?php echo $row["USERNAME"]; ?></td>
       
       
        <td>
           <!--  <a class="ajax-action-links" href='editcat.php?id=<?php echo $row['ID']; ?>'><img src="crud-icon/edit.png" title="Edit" /></a> -->
            <a class="ajax-action-links" href='deleteusers.php?id=<?php echo $row['ID']; ?>'><img src="crud-icon/delete.png" title="Delete" /></a>
         </td>
      </tr>
    <?php
        }
    }
    ?>
  </tbody>
</table>

    <!--  <tr>
     <th>#</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>E - mail ID</th>
     <th>Contact No</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
    
 
</table> -->
   
       
</div>

                            </div>

                        </div>
                        <!-- <div class="card">
                            <div class="header">
                                <h4 class="title">DISPLAY CATEGORIES</h4>
                            </div>
                            <div class="content">
                               
                            </div>
                        </div> -->
                    </div>

                    <!-- end of the secind card-->


                </div>
            </div>
        </div>


     <!--    <footer class="footer">
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
