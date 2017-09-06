<?php
function auth($username, $password, $domain = 'kq_domain_1', $endpoint = 'ldap://10.2.1.236:3268', $dc = 'OU=Kenya Airways,DC=kq,DC=kenya-airways,DC=com') {
  $ldap = @ldap_connect($endpoint);
  if(!$ldap) return false;

  ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

  $bind = @ldap_bind($ldap, "$domain\\$username", $password);
  if(!$bind) return false;

  $result = @ldap_search($ldap, $dc, "(sAMAccountName=$username)");
  if(!$result) return false;

  @ldap_sort($ldap, $result, 'sn');
  $info = @ldap_get_entries($ldap, $result);
  if(!$info) return false;
  if(!isset($info['count']) || $info['count'] !== 1) return false;

  $data = [];

  foreach($info[0] as $key => $value) {
    if(is_numeric($key)) continue;
    if($key === 'count') continue;

    $data[$key] = (array)$value;
    unset($data[$key]['count']);
  }

  return [
    'mail' => $data['mail'][0],
    'displayname' => $data['displayname'][0],
    'samaccountname' => $data['samaccountname'][0],
    'title' => $data['title'][0]
  ];
}
?>

<?php
session_start();
    if(isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'user')){
      header('Location: dashboard.php');
    }else if(isset($_SESSION['sess_username']) && ($_SESSION['sess_userrole'] == 'admin')){
      header('Location: manageusers.php');

    }
?>
<?php 
if (isset($_POST['btnLogin'])) {

    if(empty($_POST['username']) || empty($_POST['password'])) { 
          header('Location: index.php?err=3');
      } else {
          $info = auth($_POST['username'], $_POST['password']);

          if(!$info) {
              header('Location: index.php?err=1');
          }
            else{
                session_regenerate_id();
                $_SESSION['mail'] = $info['mail'];
                $_SESSION['displayname'] = $info['displayname'];
                $_SESSION['sess_username'] =  $info['samaccountname'];
                //$_SESSION['sess_userrole'] = $info['title'];//role
                $_SESSION['sess_userrole'] = $info['mail'];

                session_write_close();

                if( $_SESSION['sess_userrole'] == "brian.ochieng@kenya-airways.com" ||  $_SESSION['sess_userrole'] == "emmanuel.magak@kenya-airways.com"){
                  header('Location: manageusers.php');
                }else{
                  header('Location: dashboard.php');
                }
            }
          }

    }
        
?>
<!DOCTYPE html>
<html >
<head>
<style>
        img.smallscreen { display: none; }
        @media only screen and (max-width: 320px) {
            img { 
                display: none; 
            }
            img.smallscreen { 
                display: inline; 
            }
        }
        </style>
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
       <link href="assets/css/login.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
</head>

<body background="assets/img/kenya-airways.jpg">
  
<div class="containera">
  <div class="info">
    <h1 class="h1" style="font-family: 'Lato', sans-serif; font-weight: 700; font-style: italic; ">Kenya Airways Workshop System</h1><!-- <span>Made with <i class="fa fa-heart"></i> by <a href="http://andytran.me">Andy Tran</a></span> -->
  </div>
</div>
<div class="form">
  <div class="thumbnail1"><img src="img/kqicon.png"/></div>
 <?php 

                                $errors = array(
                                    1=>"Invalid user name or password, Try again",
                                    2=>"Please login to access this area",
                                    3=>"Enter Password and Username"
                                  );

                                $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;

                                if ($error_id == 1) {
                                        echo '<p class="text-danger">'.$errors[$error_id].'</p>';
                                    }elseif ($error_id == 2) {
                                        echo '<p class="text-danger">'.$errors[$error_id].'</p>';
                                    }
                                    elseif ($error_id == 3) {
                                        echo '<p class="text-success">'.$errors[$error_id].'</p>';
                                    }
                               ?>  
  <form class="login-form"  method="post">
    <input type="text" placeholder="username" name="username" required />
    <input type="password" placeholder="password" name="password" required />
    <button type="submit" name="btnLogin" value="Login">LOGIN</button>
    
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
