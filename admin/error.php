<?php
$message="";
session_start();
$message = $_SESSION['message'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error 404</title>
	<link rel="stylesheet" type="text/css" href="css/welcome.css">
</head>
<body>
	<div class="hue" style="background-color: rgba(255, 255, 255, 0.8); width: 50%; height: 20%; margin-top: 15%; text-align: center; margin-left: 20%; padding: 2%;">
		<br><br>
		<span style="margin-left: -68%;"><?php echo $message; ?></span>
		 <button style="float: left; margin-left: 35%; margin-top: 5%; width: 30%;" class="button"><a href="index.php">Back to Main page</a></button>
	</div>
</body>
</html>