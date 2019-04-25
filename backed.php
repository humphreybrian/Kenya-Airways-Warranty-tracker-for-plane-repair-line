<?php
include_once 'db.php';
?>
<?php
require_once('db.php');
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

    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

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
                <li >
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">DATA TABLE</a>
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

                    <div class="col-md-12">
                        <!-- <div class="card" > -->
                            <div class="header">
                                <h4 class="title">ITEMS </h4>
                                <!-- <p class="category">24 Hours performance</p> -->
                            </div>                           
                            <div class="container">
                                <table cellpadding="1" cellspacing="1" id="table_data" class="display" width="100%">
                                    <thead>
                                    <tr>
                                     
                                        <th>Unit</th>
                                        <th>Part number</th>
                                        <th>Serial number</th>
                                        <th>Date recieved</th>
                                        <th>Date removed</th>
                                        <th>Ac type</th>
                                        <th>Ac reg</th>
                                        <th>Engineer</th>
                                        <th>Position</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>  

                     
                                
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>



                
            </div>
        </div>


      

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <!-- <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="assets/js/datatables.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#table_data').DataTable({
            "columns": [
            
                { "data": "UNIT" },
                { "data": "PARTNUMBER" },
                { "data": "SERIALNUMBER" },
                { "data": "DATERCD" },
                { "data": "DATERMVD" },
                { "data": "ACTYPE" },
                { "data": "ACREG" },
                { "data": "TECH" },
                { "data": "POS" },
                { "data": "QTY" },
               
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: 'data_load.php',
                type: 'POST'
            }
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

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='deleteitems.php?id='+id;
     }
}
</script>


    <!-- this is the script that welcomes the user into the page after login-->

    <!-- <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
            $.notify({
                icon: 'ti-panel',
                message: "DASHBOARD"
            }  ,
            {
                type: 'success',
                timer: 4000
            });
        });
    </script> --> <!-- this is the end of the script that welcomes the user into the login page-->

</html>
