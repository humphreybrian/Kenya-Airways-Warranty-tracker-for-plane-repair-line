<?php
session_start();
if (isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'user')) {
    header('Location: dashboard.php');
} else if (isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'admin')) {
    header('Location: manageusers.php');

}
?>
<!DOCTYPE html>
<html>
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
    <link href="assets/css/login.css" rel="stylesheet"/>


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>

<body background="img/kq.png">

<div class="containera">
    <div class="info">
        <!-- <h1>KENYA AIRWAYS TRACKER SYSTEM</h1> -->
        <!-- <span>Made with <i class="fa fa-heart"></i> by <a href="http://andytran.me">Andy Tran</a></span> -->
    </div>
</div>
<div class="form">
    <h3>Reset Pass</h3>
    <div class="thumbnail1"><img src="img/kqicon.png"/></div>
    <?php

    $errors = array(
        1 => "Invalid user name or password, Try again",
        2 => "Please login to access this area",
        3 => "Passwords not matching"
    );

    $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;

    if ($error_id == 1) {
        echo '<p class="text-danger">' . $errors[$error_id] . '</p>';
    } elseif ($error_id == 2) {
        echo '<p class="text-danger">' . $errors[$error_id] . '</p>';
    } elseif ($error_id == 3) {
        echo '<p class="text-danger">' . $errors[$error_id] . '</p>';
    }
    ?>
    <form class="login-form" action="reset-pass.php" method="post">
        <input type="text" placeholder="username" name="username" required=/>
        <input type="password" placeholder="old password" name="old-password" required/>
        <input type="password" placeholder="new password" name="new-password" required/>
        <input type="password" placeholder="confirm password" name="confirm-password" required/>
        <button type="submit" name="btnReset" value="Reset">Reset</button>
        <span class=""><a href="index.php">Login</a></span>
        <!--  <div class="form-group">
                         <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                     </div> -->

    </form>
</div>
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
</body>
</html>
