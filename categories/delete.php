<?php
require_once("db.php");
$oci_statement=$DB_con->prepare("delete from items where id=" . $_GET['id']);
$oci_statement->execute();
header('location:table.php');
?>