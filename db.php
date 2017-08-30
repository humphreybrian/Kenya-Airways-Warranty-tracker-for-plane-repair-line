<?php
$tns = "  
 (DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=10.2.2.50)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVICE_NAME=dwhdev)
    )
  )
       ";
$db_username = "warrantytracker";
$db_password = "warranty#tracker";



try
{
 $DB_con = new PDO("oci:dbname=".$tns,$db_username,$db_password);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

// include_once 'class.crud.php';

// $crud = new crud($DB_con);

?>