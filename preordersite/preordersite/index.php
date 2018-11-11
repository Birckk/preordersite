<?php
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
<title> Home </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2> 
		<div  style="text-align:center;">
		<?php
		//checker for om man er logget ind som admin og i så fald giver mulighed for at ændre nuværende nyheder eller tilføje nye
		if ($_SESSION["u_admin"]) {	
		echo "<form method='POST' action='".setNews($conn)."'>
			<input type='hidden' name='newsid' value='".$_SESSION['news_id']."'>
			<textarea style='height:30px'; placeholder='Title' name='title'></textarea><br>
			<textarea placeholder='Message'
			 name='newsmessage'></textarea><br>
			<button class='combutton' type='submit' name='newsSubmit'>Submit news</button>
		</form>";
		}
		echo "
			<div style='display: inline-block; text-align: left;'>
		";
		//henter nyheder fra databasen
		getNews($conn);
		?>	
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>