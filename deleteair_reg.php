<?php
require_once("db.php");
$pdo_statement=$DB_con->prepare("DELETE FROM T_AIRREGNUM_WARRANTY where id=" . $_GET['id']);
$pdo_statement->execute();
header('location:aircraftregnum.php');
?>