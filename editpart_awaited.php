<?php
require_once("db.php");
if(!empty($_POST["save_record"])) {
	$pdo_statement=$DB_con->prepare("update partsawaited set sparepartnumber='" . trim($_POST[ 'sparepartnumber' ]) . "', description='" . trim($_POST[ 'description' ]) . "', reqnumber='" . trim($_POST[ 'reqnumber' ]) . "',dateofreq='" . trim($_POST[ 'dateofreq' ]) . "', engineer='" . trim($_POST[ 'engineer' ]) . "', quantity='" . trim($_POST[ 'quantity' ]) . "', storescomment='" . trim($_POST[ 'storescomment' ]) . "', dateofentry='" . trim($_POST[ 'dateofentry' ]) . "', remarks='" . trim($_POST[ 'remarks' ]) . "' , inspectionno='" . trim($_POST[ 'inspectionno' ]) . "' where id='" . $_GET["id"]."'");
	$result = $pdo_statement->execute();
	if($result) {
		header('location:parts_awaited.php');
	}
}
$pdo_statement = $DB_con->prepare("SELECT * FROM partsawaited where id='" . $_GET["id"]."'");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
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
                    <a class="navbar-brand" href="#">EDIT CATEGORIES</a>
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
                                <h4 class="title">EDIT PARTS AWAITED</h4>
                            </div>
                            <div class="content">
                               <form name="frmAdd" action="" method="POST">
                                   

                                  

                                    <div class="row">
                                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PART NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="sparepartnumber" value="<?php echo $result[0]['SPAREPARTNUMBER']; ?>" placeholder="PART NUMBER">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DESCRIPTION</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="description" value="<?php echo $result[0]['DESCRIPTION']; ?>" placeholder="DESCRIPTION">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION NUMBER</label>
                                               <input type="text" class="form-control border-input demo-form-field" name="reqnumber" value="<?php echo $result[0]['REQNUMBER']; ?>" placeholder="REQUISITION NUMBER"> 
                                            </div>
                                        </div>
                                       
                                         
                                        
                                    </div>

                                     <div class="row">
                                     
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION DATE</label>
                                               <!-- <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="REQUISITION DATE">  -->
                                               <input type="date" class="form-control border-input demo-form-field" name="dateofreq" value="<?php echo $result[0]['DATEOFREQ']; ?>" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ENGINEER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="engineer" value="<?php echo $result[0]['ENGINEER']; ?>" placeholder="ENGINEER" value="<?php echo $_SESSION['displayname']; ?>">
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input type="number" class="form-control border-input demo-form-field" name="quantity" value="<?php echo $result[0]['QUANTITY']; ?>" placeholder="QUANTITY" required="number">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                       
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>STORES COMMENTS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="storescomment" value="<?php echo $result[0]['STORESCOMMENT']; ?>" placeholder="STORES COMMENTS">
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DATE OF ENTRY</label>
                                               <!-- <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="REQUISITION DATE">  -->
                                               <input type="date" class="form-control border-input demo-form-field" name="dateofentry" value="<?php echo $result[0]['DATEOFENTRY']; ?>" placeholder="DATE OF ENTRY" required="required">
                                            </div>
                                        </div> 
                                        

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REMARKS</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="remarks" value="<?php echo $result[0]['REMARKS']; ?>" placeholder="REMARKS">
                                            </div>
                                        </div>  
                                        
                                    </div>
                                     <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INSPECTION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field" name="inspectionno" value="<?php echo $result[0]['INSPECTIONNO']; ?>" placeholder="INSPECTION NUMBER">
                                            </div>
                                        </div>

                                        
                                         
                                        
                                    </div>

                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit" value="Add" name="save_record">SAVE CHANGES</button>
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