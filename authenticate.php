<?php
require 'db.php';

session_start();

$username = "";
$password = "";

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $pass = $_POST['password'];
}
$password = md5($pass);
echo $username . " : " . $password;

$q = 'SELECT COUNT(*) FROM t_users_warranty WHERE username=:username AND password=:password';
$q1 = 'SELECT * FROM t_users_warranty WHERE username=:username AND password=:password';

$query = $DB_con->prepare($q);

$query->execute(array(':username' => $username, ':password' => $password));


if ($query->fetchColumn() == 0) {
    header('Location: index.php?err=1');
} else {

    $query1 = $DB_con->prepare($q1);
    $query1->execute(array(':username' => $username, ':password' => $password));
    $row = $query1->fetch(PDO::FETCH_ASSOC);

    session_regenerate_id();
    $_SESSION['sess_user_id'] = $row['ID'];
    $_SESSION['sess_username'] = $row['USERNAME'];
    $_SESSION['sess_userrole'] = $row['ROLE'];

    echo $_SESSION['sess_userrole'];
    session_write_close();

    if ($_SESSION['sess_userrole'] == "admin") {
        header('Location: manageusers.php');
    } else {
        header('Location: dashboard.php');
    }


}


?>