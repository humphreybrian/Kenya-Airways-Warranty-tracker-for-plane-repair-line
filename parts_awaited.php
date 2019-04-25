<?php
if (!empty($_POST["add_record"])) {
    require_once("db.php");
    $dateofreq = date('d/M/Y', strtotime($_POST['dateofreq']));
    $sql = "INSERT INTO T_PARTSAWAITED_WARRANTY (SPAREPARTNUMBER, DESCRIPTION, REQNUMBER, DATEOFREQ, ENGINEER, QUANTITY, STORESCOMMENT, DATEOFENTRY, REMARKS, INSPECTIONNO, SIGNOFF) VALUES ( :sparepartnumber, :description, :reqnumber, :dateofreq, :engineer, :quantity, :storescomment, :dateofentry, :remarks, :inspectionno, :signoff)";
    $pdo_statement = $DB_con->prepare($sql);

    $result = $pdo_statement->execute(array(':sparepartnumber' => $_POST['sparepartnumber'], ':description' => $_POST['description'], ':reqnumber' => $_POST['reqnumber'], ':dateofreq' => $dateofreq, ':engineer' => $_POST['engineer'], ':quantity' => $_POST['quantity'], ':storescomment' => $_POST['storescomment'], ':dateofentry' => $_POST['dateofentry'], ':remarks' => $_POST['remarks'], ':inspectionno' => $_POST['inspectionno'], ':signoff' => $_POST['signoff']));
    if (!empty($result)) {
        header('location:parts_awaited.php');
    }
}
?>
<?php
include_once 'db.php';
?>
<?php
session_start();
if (!isset($_SESSION['sess_username'])) {
    header('Location: index.php?err=2');
}
// $q1 = 'SELECT * FROM tbl_users WHERE username=:username ';
//     $query1 = $DB_con->prepare($q1);
//     $query1->execute(array(':username' => $_SESSION['sess_username']));
//     $row = $query1->fetch(PDO::FETCH_ASSOC);
//     extract($row);

?>
<?php
// date_default_timezone_set("UTC"); 
// echo "UTC:".time(); 
// echo "<br>"; 

date_default_timezone_set("Africa/Nairobi");
// echo "Europe/Helsinki:".time(); 
// echo "<br>"; 
?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->

    <title>KQ Workshop Tracker.</title>

    <!-- <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" /> -->


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/> -->


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
                <a href="#" class="simple-text"><img src="assets/img/kqicon.png" height="30px" width="30px"/>
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

                <li>
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
                <li>
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
                <li>
                    <a href="report.php">
                        <i class="ti-stats-up"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li>
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
                                                <?php
                                                if (isset($_GET['partnum']) and $_GET['partnum'] != null) { ?>
                                                    <input type="text" class="form-control border-input demo-form-field"
                                                           name="sparepartnumber"
                                                           value="<?php echo $_GET['partnum']; ?>" readonly>
                                                <?php } else { ?>
                                                    <input type="text" class="form-control border-input demo-form-field"
                                                           name="sparepartnumber" placeholder="PART NUMBER">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DESCRIPTION</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="description" placeholder="DESCRIPTION">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REQUISITION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="reqnumber" placeholder="REQUISITION NUMBER">
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
                                                <input type="date" class="form-control border-input demo-form-field"
                                                       name="dateofreq" placeholder="DATE RECEIVED" required="required">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>WORKORDER NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="inspectionno" placeholder="WORKORDER NUMBER">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QUANTITY</label>
                                                <input type="number" class="form-control border-input demo-form-field"
                                                       name="quantity" placeholder="QUANTITY" required="number">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>STORES COMMENTS</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="storescomment" placeholder="STORES COMMENTS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>REMARKS</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="remarks" placeholder="REMARKS">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- <label>ENGINEER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field"
                                                       name="engineer" placeholder="ENGINEER"
                                                       value="<?php echo $_SESSION['displayname']; ?>">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4"> -->
                                        <div class="form-group">
                                            <!-- <label>DATE COMPLETED</label> -->
                                            <input type="hidden"
                                                   class="form-control border-input demo-form-field datepicke"
                                                   name="signoff" value="0" placeholder="signoff" required="required">
                                        </div>
                                        <!-- </div> -->


                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!--  <label>DATE OF ENTRY</label> -->
                                                <!-- <input type="text" class="form-control border-input demo-form-field" name="tag" placeholder="REQUISITION DATE">  -->
                                                <input type="hidden" class="form-control border-input demo-form-field"
                                                       value="<?php echo date("d-M-Y"); ?>" name="dateofentry"
                                                       placeholder="DATE OF ENTRY" required="required">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit"
                                                value="Add" name="add_record">SAVE
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- start of the second card-->
                    <!--
                                        <div class="row"> -->

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <!--  <h4 class="title">ITEMS </h4> -->
                                <!-- <p class="category">24 Hours performance</p> -->
                            </div>
                            <div class="container">
                                <table cellpadding="1" class="table table-striped table-bordered" cellspacing="1"
                                       id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>

                                        <th>SPAREPARTNUMBER</th>
                                        <!-- <th class="table-header" width="20%">DESCRIPTION</th> -->
                                        <th>REQNUMBER</th>
                                        <th>QUANTITY</th>
                                        <!--                                      <th class="table-header" width="20%">STORESCOMMENT</th>-->
                                        <!-- <th >DATEOFENTRY</th> -->
                                        <!-- <th class="table-header" width="20%">DateofEnq</th>
                                        <th class="table-header" width="20%">InspectionNum</th> -->
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>


                        </div>
                        <!-- </div> -->
                    </div>
                    <!--  </div> -->


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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $('#table_data').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "partsawaitedserverside.php",
            "aoColumns": [
                {"sName": "SPAREPARTNUMBER"},
                {"sName": "REQNUMBER"},
                {"sName": "QUANTITY"},
                // { "sName": "STORESCOMMENT" },
                // { "sName": "DATEOFENTRY" },


            ],
            "columnDefs": [
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return '<?php if($_SESSION['sess_userrole'] === "certify"){ ?> <a style="padding: 0px 5px;" href="editpart_awaited.php?id=' + row[4] + '"><i class="fa fa-pencil" style="color:#DAA520;"></i></a><a style="padding: 0px 5px;" class="ajax-action-links"  href="javascript:delete_id(' + row[4] + ')" ><i class="fa fa-trash" style="color:red;"></i></a><a style="padding: 0px 5px;" class="ajax-action-links"  href="validate_partsawaited.php?id=' + row[4] + '" ><i class="fa fa-check-square-o" style="color:#2E8B57;"></i></a> <?php } ?>';
                    }
                }
            ]
        });
    });
</script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
    function delete_id(id) {
        if (confirm('Sure To Remove This Record ?')) {
            window.location.href = 'deleteparts_awaited.php?id=' + id;
        }
    }
</script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
