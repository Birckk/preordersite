<?php
	date_default_timezone_set('Europe/Copenhagen');
	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "eksamensite";
	 
// lav connection
	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
}
	include 'include/comments.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Editor</h2>
		<center>
		<?php 
		$cid = $_POST['cid'];
		$uid = $_POST['uid'];
		$newsid = $_POST['news_id'];
		$date = $_POST['date'];
		$message = $_POST['message'];

		//tekstboksen samt submit knappen til at ændre kommentaren.
		if ($uid === $_SESSION['u_id']) {
			echo 
			"<form method='POST' action='".editComments($conn)."'>
			<input type='hidden' name='cid' value='".$cid."'>
			<input type='hidden' name='uid' value='".$uid."'>
			<input type='hidden' name='news_id' value='".$newsid."'>
			<input type='hidden' name='date' value'".$date."'>
			<textarea name='message'>".$message."</textarea><br>
			<button class='combutton' type='submit' name='commentSubmit'>Edit</button>
			</form>";
			}else{
				header("location: ./news.php ");
			}
		
		
		?>	
		</center>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>
