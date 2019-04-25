<?php
require_once("db.php");
$pdo_statement=$DB_con->prepare("DELETE FROM T_ITEMS_WARRANTY where id=" . $_GET['id']);
$pdo_statement->execute();
header('location:table.php');
?>