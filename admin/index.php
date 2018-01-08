<?php include 'css.html';?>
<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM chalet ORDER BY num";
$result = mysqli_query($mysqli, $query);
session_start();
?>
<head>
	<title>Login</title>
</head>
<body>
	<div class = "dleonor">
		<h2 style="font-size: 50px;"><center>Villa Reservatio</center></h2>
	</div>
	<img src="Images/logoo.png" style="width: 30%; margin-left: 10%; margin-top: -1%;">
    <div class="login">
    	<br><br>
    	<h3>Log In</h3>
    	<br><br>
		<form class="form" action="login.php" method="post">
			<label>Admin Email: <br><br><input type="text" name="email" style="width: 100%;"></label><br><br>
			<label>Password: <br><br><input type="password" name="password" style="width: 100%;"></label><br><br>
			<a style="font-size: 13px;" href="forgot.php">Forgot Password?</a><br><br>
			<input class="btn btn-primary" type="submit" name="submit" value="Login">
			<input type="hidden" name="temp" value="0">
		</form>
	</div>
</body>