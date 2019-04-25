<?php
include_once 'db.php';
?>
<?php
session_start();
if (!isset($_SESSION['sess_username'])) {
    header('Location: index.php?err=2');
}


date_default_timezone_set("Africa/Nairobi");
// echo "Europe/Helsinki:".time(); 
// echo "<br>"; 

if (isset($_GET['category']) && $_GET['category'] != null) {
    $category = "%" . $_GET['category'] . "%";
    $reg = "%" . $_GET['air_reg'] . "%";
    $typp = "%" . $_GET['air_type'] . "%";
    $partnum = "%" . $_GET['partnumber'] . "%";
    $start_date = date('d/M/Y', strtotime($_GET['date1']));
    $stop_date = date('d/M/Y', strtotime($_GET['date2']));

    $sql = 'SELECT * FROM t_items_warranty WHERE category LIKE ? AND acreg LIKE ? AND actype LIKE ? AND partnumber LIKE ? AND( ( DATERCD BETWEEN ? and ?) OR ( POSTEDAT BETWEEN ? and ?) )';
    $q = $DB_con->prepare($sql);
    $q->execute(array($category, $reg, $typp, $partnum, $start_date, $stop_date, $start_date, $stop_date));


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
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

<div class="wrapper " style="background: #f4f3ef!important;">
    <span style="margin: 20px;"></span>

    <div class="container" style="background: #fff;">
        <div class="row">

            <div class="info col-md-6 col-md-offset-3">
                <img class="" style="padding: 5px; margin-top: 30px;" src="kq.png" height="100dp">
            </div>
            <br>

            <div class="info col-md-12">
                <form>
                    <input type=button name=print value="Print Report" onClick="window.print()"
                           class="btn btn-danger btn-fill btn-wd demo-form-submit">
                </form>
                <h3 class="h3 text-center"
                    style="font-family: 'Lato', sans-serif; font-weight: 100; font-style: italic; ">Kenya Airways
                    Workshop System</h3>
                <h4>Kenya Airways Workshop Tracker<br>Reports for Workshop Tracker<br> for a period
                    of <?php echo $start_date = date('d/M/Y', strtotime($_GET['date1'])); ?>
                    to <?php echo $stop_date = date('d/M/Y', strtotime($_GET['date2'])); ?>, <br> Done
                    by <?php echo $_SESSION['displayname']; ?>, <br> On <?php echo date("d-M-Y h:i:s a"); ?>. </h4>
                <!-- <span>Made with <i class="fa fa-heart"></i> by <a href="http://andytran.me">Andy Tran</a></span> -->
            </div>
        </div>


        <div class="row" style="padding: 15px;">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <th>Inspection No</th>
                    <th>Work Order</th>
                    <th>Unit</th>
                    <TH>Part No</TH>
                    <TH>Serial No</TH>
                    <th>Date Received</th>
                    <th>Date ReMOVED</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($q as $row):
                    extract($row);
                    ?>
                    <tr>
                        <td><?php echo $INSPECNO; ?></td>
                        <td><?php echo $WORKORDER; ?></td>
                        <td><?php echo $UNIT; ?></td>
                        <TD><?php echo $PARTNUMBER; ?></TD>
                        <td><?php echo $SERIALNUMBER; ?></td>
                        <td><?php echo $DATERCD; ?></td>
                        <td><?php echo $DATERMVD; ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
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
<!--  <script src="assets/js/bootstrap-notify.js"></script> -->

<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        weekStart: 1,
        color: 'red'
    });
</script>


</html>
