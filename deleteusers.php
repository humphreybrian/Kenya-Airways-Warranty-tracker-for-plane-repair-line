<?php
require_once("db.php");
$pdo_statement=$DB_con->prepare("DELETE FROM TBL_USERS where id=" . $_GET['id']);
$pdo_statement->execute();
header('location:manageusers.php');
?>