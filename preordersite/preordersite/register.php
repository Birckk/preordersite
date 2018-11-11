<!DOCTYPE html>
<html>
<head>
<title> Register </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>register</h2>
		<!-- input felter til registrering-->
		<form class="signup-form" action="include/register.inc.php" method="POST">
			<input type="text" name="first" placeholder="Firstname">
			<input type="text" name="last" placeholder="Lastname">
			<input type="text" name="email" placeholder="E-mail">
			<input type="text" name="uid" placeholder="Username">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" name="submit">Register</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

</body>
</html>
