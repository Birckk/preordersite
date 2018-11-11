<?php

function setComments($conn,$newsid){
	//indsætter comments data uid,message og automatisk dato i databasen når brugeren har indtastet og submittet via news.php
	if (isset($_POST['commentSubmit'])) {
		$uid = $_POST['uid'];
		$message = $_POST['message'];

		$sql = "INSERT INTO comments (uid, message, news_id) VALUES ('$uid', '$message', '$newsid')";
		$result = mysqli_query($conn, $sql);
	}
}

function getComments($conn, $id=-1) {
	//henter alle comments ned på  news.php som tilhører den specifikke news når man har trykket på en specifik nyhed 
	$sql = ($id > 0)? "SELECT comments.*, users.user_uid FROM comments INNER JOIN users ON comments.uid = users.user_id WHERE comments.news_id = $id" : "SELECT comments.*, users.user_uid FROM comments INNER JOIN users ON comments.uid = users.user_uid";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<div class=comment-box><p>";
		echo "<p><b>user: </b>";
		echo $row['user_uid']."</p>";
		echo "<p><u>date:</u> ";
		echo $row['date']."</p>";
		echo nl2br($row['message']);
		echo (isset($_SESSION['u_id']) && $row['uid'] === $_SESSION['u_id']? "</p>
			<form class='delete-form' method='POST' action='".deleteComments($conn)."'>
				<input type='hidden' name='cid' value='".$row['cid']."'>
				<input type='hidden' name='news_id' value='".$_GET['id']."'>
				<button name='commentDelete'>Delete</button>
			</form>
			<form class='edit-form'  method='POST' action='editcomment.php'>
				<input type='hidden' name='cid' value='".$row['cid']."'>
				<input type='hidden' name='news_id' value='".$_GET['id']."'>
				<input type='hidden' name='uid' value='".$row['uid']."'>
				<input type='hidden' name='date' value='".$row['date']."'>
				<input type='hidden' name='message' value='".$row['message']."'>
				<button>Edit</button>
			</form>" : "");
		echo "</div>";
			
	}
}

function editComments($conn){
	//ændrer comment dataen "message" på databasen efter submittet fra editcomments.php
	if (isset($_POST['commentSubmit'])) {
		$cid = $_POST['cid'];
		$uid = $_POST['uid'];
		$newsid = $_POST['news_id'];
		$date = $_POST['date'];
		$message = $_POST['message'];

		$sql = "UPDATE comments SET message='$message' WHERE cid='$cid' ";
		$result = mysqli_query($conn, $sql);
		header("Location: news.php?id=$newsid");
	}
}

function deleteComments($conn){
	//sletter den givne comment ud fra cid
	if (isset($_POST['commentDelete'])) {
		$cid = $_POST['cid'];
		$news_id = (string)$_POST['news_id'];

		$sql = "DELETE FROM comments WHERE cid='$cid'";
		$result = mysqli_query($conn, $sql);
		header("Location: news.php?id=$news_id");
	}
}