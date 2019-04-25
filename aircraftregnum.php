<?php
if (!empty($_POST["add_record"])) {
    require_once("db.php");
    $sql = "INSERT INTO T_AIRREGNUM_WARRANTY ( REGNUM, USERNAME, POSTEDAT ) VALUES ( :regnum, :username, :POSTEDAT )";
    $pdo_statement = $DB_con->prepare($sql);

    $result = $pdo_statement->execute(array(':regnum' => $_POST['regnum'], ':username' => $_POST['username'], ':postedat' => $_POST['postedat']));
    if (!empty($result)) {
        header('location:aircraftregnum.php');
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
<!doctype html>
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">AIRCRAFT REGISTRATION NUMBER</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li> -->
                        <!--  <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                     <i class="ti-bell"></i>
                                     <p class="notification">5</p>
                                     <p>Notifications</p>
                                     <b class="caret"></b>
                               </a>
                               <ul class="dropdown-menu">
                                 <li><a href="#">Notification 1</a></li>
                                 <li><a href="#">Notification 2</a></li>
                                 <li><a href="#">Notification 3</a></li>
                                 <li><a href="#">Notification 4</a></li>
                                 <li><a href="#">Another notification</a></li>
                               </ul>
                         </li> -->
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
                                <h4 class="title">ADD AIRCRAFT REGISTRATION NUMBER</h4>
                            </div>
                            <div class="content">
                                <!--   <div style="margin:20px 0px;text-align:right;"><a href="table.php" class="button_link">Back to List</a></div> -->
                                <!-- <div class="frm-add"> -->
                                <!-- <h1 class="demo-form-heading">Add New Record</h1> -->
                                <!-- <form name="frmAdd" action="" method="POST">
                                  <div class="demo-form-row">
                                      <label>Title: </label><br>
                                      <input type="text" name="post_title" class="demo-form-field" required />
                                  </div>
                                  <div class="demo-form-row">
                                      <label>Description: </label><br>
                                      <textarea name="description" class="demo-form-field" rows="5" required ></textarea>
                                  </div>
                                  <div class="demo-form-row">
                                      <label>Date: </label><br>
                                      <input type="date" name="post_at" class="demo-form-field" required />
                                  </div>
                                  <div class="demo-form-row">
                                      <input name="add_record" type="submit" value="Add" class="demo-form-submit">
                                  </div>
                                  </form> -->
                                <!-- </div> -->
                                <form name="frmAdd" action="" method="POST">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>AIRCRAFT REGITSRATION NUMBER</label>
                                                <input type="text" class="form-control border-input demo-form-field"
                                                       name="regnum" placeholder="Aircraft registration number">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!-- <label>USER</label> -->
                                                <input type="hidden" class="form-control border-input demo-form-field"
                                                       value="<?php echo $_SESSION['displayname']; ?>" readonly=""
                                                       name="username" placeholder="USERNAME">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!-- <label>DATEPOSTED</label> -->
                                                <input type="hidden" value="<?php echo date("d-M-Y"); ?>"
                                                       class="form-control border-input demo-form-field" name="postedat"
                                                       placeholder="UNIT">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="text-center">
                                        <button type="submit" name="add_record" value="Add"
                                                class="btn btn-danger btn-fill btn-wd demo-form-submit">ADD AIRCRAFT
                                            REGISTRATION NUMBER
                                        </button>
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
                                <h4 class="title">MANAGE AIRCRAFTS</h4>
                            </div>
                            <div class="content">
                                <table cellpadding="1" class="table table-striped table-bordered" cellspacing="1"
                                       id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>

                                        <th>AIRCRAFT REGISTRATION NUMBER</th>
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

                    <!-- end of the secind card-->


                </div>
            </div>
        </div>

        <!-- <div class="content">
            <div class="container-fluid">
                <div class="card card-map">
                    <div class="header">
                        <h4 class="title">Google Maps</h4>
                    </div>
                    <div class="map">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <footer class="footer">
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $('#table_data').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "airreg_serverside.php",
            "aoColumns": [
                {"sName": "TYPE"},
                // { "sName": "CATEGORY" },
                // { "sName": "TAG" },
                // { "sName": "DATERCD" },
                // { "sName": "DATERMVD" },


            ],
            "columnDefs": [
                {
                    "targets": 1,
                    "render": function (data, type, row, meta) {
                        return '<a href="editair_reg.php?id=' + row[1] + '"><i class="fa fa-pencil" style="color:#DAA520;"></i></a><a class="ajax-action-links"  href="javascript:delete_id(' + row[1] + ')" ><i class="fa fa-trash" style="color:red;"></i></a>';
                    }
                }
            ]
        });
    });
</script>
<script type="text/javascript">
    function delete_id(id) {
        if (confirm('Sure To Remove This Record ?')) {
            window.location.href = 'deleteair_reg.php?id=' + id;
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

<script>
    $().ready(function () {
        demo.initGoogleMaps();
    });
</script>

</html>
