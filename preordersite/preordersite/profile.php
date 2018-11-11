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

function getProfile($conn) {
	//enkelte linjes if function /turnary
		$uid = $_SESSION['u_id'];
		//finder sales og indsætter dataen fra products ind på de forskellige steder som name, image og end_date for produktet
		$sql = "SELECT products.name, products.image, products.end_date FROM sales INNER JOIN products ON sales.product_id = products.id WHERE sales.user_id = $uid";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {	
		echo "<center><div>";
		echo "<div>";
		echo "<div id='pleasefix' class='profilebox'><p>";
		echo "<img src='{$row['image']}'><br><b>product: </b>";
		echo $row['name']."<br> <b>End-date: </b>";
		echo $row['end_date']."<br>";
		echo $row["price"];
		echo "</p></div></center>";
		echo "</div>";
		echo "</div></center>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title> Profile </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Profile</h2>
			<div>
				<?php
				//hvis logget ind kører den funktionen get profile så man kan se ens sales
				if(isset($_SESSION['u_id'])){
					getProfile($conn);
				} else {
					header("location: ./index.php ");
				}
				
				?>
			</div>
		<br>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>