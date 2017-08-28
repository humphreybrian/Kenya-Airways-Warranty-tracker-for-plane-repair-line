<?php
require_once("db.php");
$pdo_statement=$DB_con->prepare("DELETE FROM AIRREGNUM where id=" . $_GET['id']);
$pdo_statement->execute();
header('location:aircraftregnum.php');
?>