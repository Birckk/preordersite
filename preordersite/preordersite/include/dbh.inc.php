<? php
 //min connect hvor jeg connector til databasen ved hjælp af xampp og phpMyAdmin

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "eksamensite";
 
// lav connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
  /* essentielt præcist det samme som ovenover bare lidt anderledes variabel navne
$host = "localhost";
$username = "root";
$password = "";
$dbname = "eksamensite";

$conn = mysqli_connect($host, $username, $password, $dbname);
    */
?>
