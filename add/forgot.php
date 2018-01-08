<?php
/* Password reset process, updates database with new user password */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'POS';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // Make sure the two passwords match
    if ( $_POST['email'] == $_POST['email2'] ) {
    	$email = $mysqli->escape_string($_POST['email']);
        $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $sql = "UPDATE users SET password = '$password' WHERE email='$email'";
        if ( $mysqli->query($sql) ) {
        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: login.php");    
        }
    }
    else {
        $_SESSION['message'] = "Two emails you entered don't match, try again!";
        header("location: error.php");    
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot password</title>
    <link rel="stylesheet" type="text/css" href="lalal.css">
</head>
<body>
	<div class="indent">
		<form action="forgot.php" method="POST">
			<br>
            <h1>Change Password</h1>
			<label>Enter E-mail: <input type="text" style="margin-left: 3%;" name="email" required></label>
			<br><br>
			<label>Re-type E-mail: <input type="text" name="email2" required></label>
			<br><br>
			<label>New password: <input type="password" name="password" required></label>
            <br><br>
			<a href="rides.php"><input type="submit" style="width: 20%;" name="Update" value="Update"></a>
            <br><br>
		</form>
	</div>
</body>
</html>