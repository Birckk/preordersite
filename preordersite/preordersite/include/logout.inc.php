<?php
//lukke for den nuværende session så man ikke længere er logget ind.
if (isset($_POST['submit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: ../index.php");
}