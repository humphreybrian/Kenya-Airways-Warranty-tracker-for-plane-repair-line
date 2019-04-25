<?php
if (!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO T_CATEGORIES_WARRANTY (   DEPARTMENT, CATEGORY, TAG, DELETED, CREATEDBY, CREATEDON, LASTEDITEDBY, LASTEDITEDON, LASTEDITED, POSTEDAT ) VALUES ( :department, :category, :tag, :deleted, :createdby, :createdon, :lasteditedby, :lasteditedon, :lastedited, :postedat )";
    $pdo_statement = $DB_con->prepare($sql);

    $result = $pdo_statement->execute(array(':department' => $_POST['department'], ':category' => $_POST['category'], ':tag' => $_POST['tag'], ':deleted' => $_POST['deleted'], ':createdby' => $_POST['createdby'], ':createdon' => $_POST['createdon'], ':lasteditedby' => $_POST['lasteditedby'], ':lasteditedon' => $_POST['lasteditedon'], ':lastedited' => $_POST['lastedited'], ':postedat' => $_POST['postedat']));
    if (!empty($result)) {
        header('location:categories.php');
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
                <li class="active">
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
                <li>
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
                    <a class="navbar-brand" href="#">CATEGORIES</a>
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
                                <h4 class="title">ADD CATEGORY</h4>
                            </div>
                            <div class="content">
                                <form name="frmAdd" action="" method="POST">


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CATEGORY</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="category" placeholder="CATEGORY">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TAG</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="tag" placeholder="TAG">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>DEPARTMENT</label>

                                                <select title="department" name="department" id="department"
                                                        class="form-control border-input" required="required">
                                                    <!-- <option >Select below</option> -->
                                                    <option value="">Select Department</option>
                                                    <option value="avionics">avionics</option>
                                                    <option value="mechanical">mechanical</option>
                                                    <option value="NDT">NDT</option>
                                                    <option value="ULD">ULD</option>
                                                    <option value="UPHOLSTRY">UPHOLSTRY</option>
                                                    <option value="ULD">None</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!-- <label>USER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field"
                                                       value="<?php echo $_SESSION['displayname']; ?>" readonly=""
                                                       name="createdby" placeholder="USERNAME">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- <label>DATEPOSTED</label> -->
                                                    <input type="hidden" value="<?php echo date("d-M-Y"); ?>"
                                                           class="form-control border-input demo-form-field"
                                                           name="postedat" placeholder="UNIT">
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit"
                                                value="Add" name="add_record">ADD CATEGORY
                                        </button>
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
                                <!--  <h4 class="title">ITEMS </h4> -->
                                <!-- <p class="category">24 Hours performance</p> -->
                            </div>
                            <div class="container">
                                <table cellpadding="1" class="table table-striped table-bordered" cellspacing="1"
                                       id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>

                                        <th class="table-header" width="20%">DEPARTMENT</th>
                                        <!-- <th class="table-header" width="20%">DESCRIPTION</th> -->
                                        <th class="table-header" width="20%">CATEGORY</th>
                                        <th class="table-header" width="20%">TAG</th>
                                        <!-- <th class="table-header" width="20%">STORESCOMMENT</th> -->
                                        <!-- <th >DATEOFENTRY</th> -->
                                        <!-- <th class="table-header" width="20%">DateofEnq</th>
                                        <th class="table-header" width="20%">InspectionNum</th> -->
                                        <th class="table-header" width="5%">Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>


                        </div>
                        <!-- </div> -->
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

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $('#table_data').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "categoriesserverside.php",
            "aoColumns": [
                {"sName": "DEPARTMENT"},
                {"sName": "CATEGORY"},
                {"sName": "TAG"},
                // { "sName": "DATERCD" },
                // { "sName": "DATERMVD" },


            ],
            "columnDefs": [
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return '<a href="editcat.php?id=' + row[3] + '"><i class="fa fa-pencil" style="color:#DAA520;"></i></a><a class="ajax-action-links"  href="javascript:delete_id(' + row[3] + ')" ><i class="fa fa-trash" style="color:red;"></i></a>';
                    }
                }
            ]
        });
    });
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
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
    function delete_id(id) {
        if (confirm('Sure To Remove This Record ?')) {
            window.location.href = 'deletecat.php?id=' + id;
        }
    }
</script>


<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
