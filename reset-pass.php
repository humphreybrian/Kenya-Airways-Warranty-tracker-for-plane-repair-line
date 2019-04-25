<?php 
	require 'db.php';

	session_start();

	$username = "";
	$password = "";
	
	if(isset($_POST['username'])){
		$username = $_POST['username'];
	}
	if (isset($_POST['old-password'])) {
		$pass = $_POST['old-password'];
	}
	if (isset($_POST['new-password'])) {
		$new_pass = $_POST['new-password'];
	}
	if (isset($_POST['confirm-password'])) {
		$con_pass = $_POST['confirm-password'];
	}
	$password = md5($pass);
	$new_password = md5($new_pass);
	echo $username ." : ".$password;

	$q = 'SELECT COUNT(*) FROM t_users_warranty WHERE username=:username AND password=:password';

	$query = $DB_con->prepare($q);

	$query->execute(array(':username' => $username, ':password' => $password));


	if($query->fetchColumn() == 0){
		header('Location: reset.php?err=1');
	}else{
		if ($new_pass != $con_pass) {
			header('Location: reset.php?err=3');
		}else{
			$q1 = 'SELECT * FROM t_users_warranty WHERE username=:username AND password=:password';
			$query1 = $DB_con->prepare($q1);
			$query1->execute(array(':username' => $username, ':password' => $password));
			$row = $query1->fetch(PDO::FETCH_ASSOC);

			$pdo_statement=$DB_con->prepare("update tbl_users set password='" . $new_password . "' where id=" . $row['ID']);
			$result = $pdo_statement->execute();
			if($result) {
				header('Location: index.php?err=3');
	}

		}
		
	}


?>