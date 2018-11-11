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
	include 'include/Newsposts.inc.php';
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
		$newsid = $_POST['news_id'];
		$title = $_POST['title'];
		$date = $_POST['date'];
		$newsmessage = $_POST['newsmessage'];
		//tekstboksen samt submit knappen til at ændre nyheden.
			echo 
			"<form method='POST' action='".editNews($conn)."'>
			<input type='hidden' name='news_id' value='".$newsid."'>
			<input type='hidden' name='title' value='".$title."'>
			<input type='hidden' name='date' value'".$date."'>
			<textarea name='newsmessage'>".$newsmessage."</textarea><br>
			<button class='combutton' type='submit' name='newsEdit'>Edit</button>
			</form>";
		?>	
		</center>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>
