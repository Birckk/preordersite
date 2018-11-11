<?php

function setNews ($conn){
	//indsætter news data newsid,title og newsmessage i databasen når admin-brugeren har indtastet og submittet via index.php
	if (isset($_POST['newsSubmit'])) {
		$newsid = $_POST['newsid'];
		$title = $_POST['title'];
		$newsmessage = $_POST['newsmessage'];

		$sql = "INSERT INTO news (news_id, title, newsmessage) VALUES ('$newsid', '$title', '$newsmessage')";
		$result = mysqli_query($conn, $sql);
	}
}

function getnews($conn, $id=-1) {
	//henter alle news ned på index samt den enkelte news når man har trykket på en specifik nyhed hvorefter den news så kan ses på news.php samt dens tilhørende comments sammen med getComments
	$sql = ($id > 0)? "SELECT * FROM news WHERE news_id=$id ORDER BY news.date DESC" : "SELECT * FROM news ORDER BY news.date DESC";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<div class=news-box><p style='font-size: 20px'>";
			echo "<a href='news.php?id={$row['news_id']}'>". nl2br($row['title']."</a></p></p>");
			echo $row['date']."<br><br>";
			echo nl2br($row['newsmessage']);
		if ($_SESSION["u_admin"]) {	
		echo "</p>
			<form class='delete-form' method='POST' action='".deleteNews($conn)."'>
				<input type='hidden' name='news_id' value='".$row['news_id']."'>
				<button name='newsDelete'>Delete</button>
			</form>
			<form class='edit-form'  method='POST' action='editnews.php'>
				<input type='hidden' name='news_id' value='".$row['news_id']."'>
				<input type='hidden' name='title' value='".$row['title']."'>
				<input type='hidden' name='date' value='".$row['date']."'>
				<input type='hidden' name='newsmessage' value='".$row['newsmessage']."'>
				<button>Edit</button>
			</form>";
		}
		echo "</div>";
	}
}

function editNews($conn){
	if (isset($_POST['newsEdit'])) {
		//ændrer news dataen "newsmessage" på databasen efter submittet fra editnews.php
		$newsid = $_POST['news_id'];
		$title = $_POST['title'];
		$date = $_POST['date'];
		$newsmessage = $_POST['newsmessage'];

		$sql = "UPDATE news SET newsmessage='$newsmessage' WHERE news_id='$newsid' ";
		$result = mysqli_query($conn, $sql);
		header("Location: index.php");
	}
}

function deleteNews($conn){
	if (isset($_POST['newsDelete'])) {
		//sletter den givne nyhed ud fra news_id
		$newsid = $_POST['news_id'];
		$sql = "DELETE FROM news WHERE news_id='$newsid'";
		$result = mysqli_query($conn, $sql);
		header("Location: index.php");
	}
}