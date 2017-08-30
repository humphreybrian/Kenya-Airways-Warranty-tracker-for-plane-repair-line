<?php
if(!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO POSTS ( PART_NUM, DESCRIPTION, REQUISITION_NUM, REQUISITION_DATE, INSPECTION_NUM, REMARKS, ENGINNER, STORES_COMMENTS, QUANTITY, USERNAME) VALUES ( :part_num, :description, :requisition_num, :requisition_date, :inspection_num, :remarks, :enginner, :stores_comments, :quantity, :username)";
    $pdo_statement = $DB_con->prepare( $sql );
        
    $result = $pdo_statement->execute( array( ':part_num'=>$_POST['part_num'], ':description'=>$_POST['description'], ':requisition_num'=>$_POST['requisition_num'], ':requisition_date'=>$_POST['requisition_date'], ':inspection_num'=>$_POST['inspection_num'], ':remarks'=>$_POST['remarks'], ':enginner'=>$_POST['enginner'], ':stores_comments'=>$_POST['stores_comments'], ':quantity'=>$_POST['quantity'], ':username'=>$_POST['username'] ) );
    if (!empty($result) ){
      header('location:parts_awaited.php');
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">PARTS AWAITED</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
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
                                <h4 class="title">PARTS AWAITED</h4>
                            </div>
                            <div class="content">
                               <form name="frmAdd" action="" method="POST">
                                   

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PART NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="part_num" placeholder="PART NUMBER">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DESCRIPTION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="description" placeholder="DESCRIPTION">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION NUMBER</label>
                                               <input type="text" class="form-control border-input demo-form-field" name="requisition_num" placeholder="REQUISITION NUMBER"> 
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION DATE</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="TAG">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INSPECTION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="TAG">
                                            </div>
                                        </div> -->
                                         
                                        
                                    </div>




                                    <div class="row">
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PART NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="category" placeholder="CATEGORY">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DESCRIPTION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="TAG">
                                            </div>
                                        </div> -->
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION DATE</label>
                                               <!-- <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="REQUISITION DATE">  -->
                                               <input type="date" class="form-control border-input demo-form-field" name="requisition_date" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INSPECTION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="inspection_num" placeholder="INSPECTION NUMBER">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REMARKS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="remarks" placeholder="REMARKS">
                                            </div>
                                        </div>
                                         
                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ENGINEER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="enginner" placeholder="ENGINEER">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>STORES COMMENTS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="stores_comments" placeholder="STORES COMMENTS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="quantity" placeholder="QUANTITY" required="number">
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION DATE</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="TAG">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INSPECTION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="TAG">
                                            </div>
                                        </div> -->
                                         
                                        
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>USER</label>
                                                <input type="text" class="form-control border-input demo-form-field" value="<?php echo $USERNAME ?>" readonly="" name="username" placeholder="USERNAME">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit" value="Add" name="add_record">SAVE</button>
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
                                <h4 class="title">PARTS AWAITED DATA</h4>
                               <!--  <p class="category">Here is a subtitle for this table</p> -->
                            </div>
                            <?php   
    $pdo_statement = $DB_con->prepare("SELECT * FROM POSTS ORDER BY id ASC");
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
?>

                            <div class="content table-responsive table-full-width">
                                <div class="container">
     <!-- <table class='table table-bordered table-responsive'> -->
    
<table class="tbl-qa table table table-bordered table-responsive ">
  <thead>
    <tr>

    <!-- <th class="table-header" width="20%">ID</th> -->
      <th class="table-header" width="20%">PART_NUM</th>
      <!-- <th class="table-header" width="20%">DESCRIPTION</th> -->
      <th class="table-header" width="20%">REQ_NUMBER</th>
       <th class="table-header" width="20%">REQ_DATE</th>
      <th class="table-header" width="20%">INSPECTION_NUM</th>
      <th class="table-header" width="20%">REMARKS</th>
      <th class="table-header" width="20%">ENGINNER</th>
      <th class="table-header" width="20%">QUANTITY</th>
      <th class="table-header" width="5%">Actions</th> 
    </tr>
  </thead>
  <tbody id="table-body">
    <?php
    if(!empty($result)) { 
        foreach($result as $row) {
    ?>
      <tr class="table-row">
      
        <td><?php echo $row["PART_NUM"]; ?></td>
        
        <td><?php echo $row["REQUISITION_NUM"]; ?></td>
        <td><?php echo $row["REQUISITION_DATE"]; ?></td>
        <td><?php echo $row["INSPECTION_NUM"]; ?></td>
        <td><?php echo $row["REMARKS"]; ?></td>
        <td><?php echo $row["ENGINNER"]; ?></td>
      
        <td><?php echo $row["QUANTITY"]; ?></td>
       
        <td>
            <a class="ajax-action-links" href='editpart_awaited.php?id=<?php echo $row['ID']; ?>'><!-- <i class="ti-pencil-alt" title="EDIT"></i> --><img src="crud-icon/edit.png" title="Edit" /></a>
            &nbsp&nbsp&nbsp
            <a class="ajax-action-links" href='deleteparts_awaited.php?id=<?php echo $row['ID']; ?>'><!-- <i class="ti-close" title="DELETE"></i> --><img src="crud-icon/delete.png" title="Delete" /></a>
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
