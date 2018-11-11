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
	include 'include/comments.inc.php';
	include 'include/Newsposts.inc.php';
	$newsid=$_GET["id"];
?>

<!DOCTYPE html>
<html>
<head>
<title> News </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>News</h2>
		<div  style="text-align:center;">
		<?php 
		echo "	
			<div style='display: inline-block; text-align: left;'>
		";
		//finder en spefic nyhed ud fra den valgte newsid og tilhørende kommentarer hertil
		getnews($conn, $newsid);
		getComments($conn, $newsid);
		
		//checker for om man er logget ind for at vise delete og edit buttons til brugerens egne kommentarer samt kommentar felt for brugere der er logget ind
		if(isset($_SESSION['u_id'])) {

			setComments($conn,$newsid);

			echo "<form method='POST' action='news.php?id=$newsid'>
			<input type='hidden' name='uid' value='".$_SESSION['u_id']."'>
			<input type='hidden' name='news_id' value='".$newsid."'>
			<textarea name='message'></textarea><br>
			<button class='combutton' type='submit' name='commentSubmit'>Comment</button>
			</form>";
		} else {
			//kasse til når man ikke er logget ind
			echo "<div style='width: 200px; padding-top: 1px; padding-bottom: 25px;height: 30px; background-color: #282828;  border:none; margin:0 auto; color:#fff; font-family:arial; font-weight:400px;'>";
			echo "<div class='notlogcom'>
			<p>to comment please login</p>
			</div>";
			echo "</div>";
		}	
		?>	
			</div>
		</div>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>
