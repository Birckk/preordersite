<?php
//checker for at nogen har trykket på submit knappen til at de vil registrere en user
if (isset($_POST['submit'])) {

	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "eksamensite";
 
// lav connection
	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	//variabler til dannelse af bruger
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Errors
	//tomme felter
	if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
		header("Location: ../register.php?signup=empty");
		exit();
	} else {
		//check om input for navne er valid
		if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
		header("Location: ../register.php?signup=invalid");
		exit();
		} else  {
		//check for hvis email er valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../register.php?signup=email");
				exit();
			} else {
				//checker om username er taget
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../register.php?signup=usertaken");
					exit();
				} else {
					//hasher passwordet
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//sætte user i database
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
					mysqli_query($conn, $sql);
					header("Location: ../register.php?signup=succes");
					exit();
				}
			}
		}
	}

} else {
	header("Location: ../register.php");
	exit();


}


