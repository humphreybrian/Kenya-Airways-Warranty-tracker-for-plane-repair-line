<?php
require_once("db.php");
session_start();

if (!isset($_SESSION['sess_username'])) {
    header('Location: index.php?err=2');
}
if ($_SESSION['sess_userrole'] != "admin") {
    header('Location: index.php?err=4');
}
?>

<?php
// start session
////
// check if username is admin
// if($_SESSION['sess_userrole'] !== 'admin'){
//     // isn't admin, redirect them to a different page
//     header("Location: dashboard.php");
// }
?>

<?php
if (!empty($_POST["add_record"])) {
    // $passhash = md5($_POST['password']);
    $sql = "INSERT INTO T_USERS_WARRANTY ( USERNAME, ROLE,CODE ) VALUES ( :username, :role,:authcode )";
    $pdo_statement = $DB_con->prepare($sql);

    $result = $pdo_statement->execute(array(':username' => $_POST['username'], ':role' => $_POST['role'],':authcode' => $_POST['authcode']));
    if (!empty($result)) {
        header('location:manageusers.php');
    }
}

// $q1 = 'SELECT * FROM tbl_users WHERE username=:username ';
// $query1 = $DB_con->prepare($q1);
// $query1->execute(array(':username' => $_SESSION['sess_username']));
// $row = $query1->fetch(PDO::FETCH_ASSOC);
// extract($row);

include_once 'db.php';
?>
<?php
// date_default_timezone_set("UTC"); 
// echo "UTC:".time(); 
// echo "<br>"; 

date_default_timezone_set("Africa/Nairobi");
// echo "Europe/Helsinki:".time(); 
// echo "<br>"; 
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/kqicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>KQ Workshop Tracker.</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>


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
                            <a href="#">
                                <i class="ti-alarm-clock">&nbsp</i>
                                <?php echo date("d-M-Y h:i:s a"); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-user">&nbsp;</i>
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
                                <h4 class="title">ADD USER </h4>
                            </div>
                            <div class="content">
                                <form name="frmAdd" action="" method="POST">


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>USER NAME</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="username" placeholder="username">
                                            </div>
                                        </div>
                                        <!--  <div class="col-md-4">
                                             <div class="form-group">
                                                 <label>PASSWORD</label>
                                                 <input type="text" value="user1234" class="form-control border-input demo-form-field" name="password" readonly placeholder="password">
                                             </div>
                                         </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ROLE</label>

                                                <select title="role" name="role" id="role" class="form-control"
                                                        required="required">
                                                    <!-- <option >Select below</option> -->
                                                    <option value="admin">ADMIN</option>
                                                    <option value="certify">CERTIFYING</option>
                                                    <option value="user">NORMAL USER</option>

                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AUTHORITY CODE</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="authcode" placeholder="CODE">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-fill btn-wd demo-form-submit"
                                                value="Add" name="add_record">ADD USER
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- start of the second card-->

                    <!-- Data tables for Manage users -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">MANAGE users</h4>
                            </div>
                            <div class="content">
                                <table cellpadding="1" class="table table-striped table-bordered" cellspacing="1"
                                       id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>

                                        <th>USERNAME</th>
                                        <th>ROLE</th>
                                        <th>CODE</th>
                                        <!-- <th class="table-header" width="20%">DESCRIPTION</th> -->
                                        <!-- <th class="table-header" width="20%">CATEGORY</th>
                                         <th class="table-header" width="20%">TAG</th> -->
                                        <!-- <th class="table-header" width="20%">STORESCOMMENT</th> -->
                                        <!-- <th >DATEOFENTRY</th> -->
                                        <!-- <th class="table-header" width="20%">DateofEnq</th>
                                        <th class="table-header" width="20%">InspectionNum</th> -->
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>


                                <!-- this is the place for the content of the table aircraft types-->

                            </div>
                        </div>
                    </div>
                    <!-- Enf of the data tables for manage users --->

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
            "sAjaxSource": "users_serverside.php",
            "aoColumns": [
                {"sName": "USERNAME"},
                {"sName": "ROLE"},
                {"sName": "CODE"},

            ],
            "columnDefs": [
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return '<a href="editusers.php?id=' + row[3] + '"><i class="fa fa-pencil" style="color:#DAA520;"></i></a><a class="ajax-action-links"  href="javascript:delete_id(' + row[3] + ')" ><i class="fa fa-trash" style="color:red;"></i></a>';
                    }
                }
            ]
        });
    });
</script>
<script type="text/javascript">
    function delete_id(id) {
        if (confirm('Sure To Remove This Record ?')) {
            window.location.href = 'deleteusers.php?id=' + id;
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
