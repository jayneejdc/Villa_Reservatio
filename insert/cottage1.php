<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$contact = $_POST['contact'];	
$checkin = $_POST['checkin'];
$type = $_POST['type'];

$time=date("m/d/Y");
$price ='';
$kol=1;

$query = "SELECT * FROM rooms";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
	if ($type==$row[0]) {
		$temps=$row[0];
		$price=$row[2];
		$query = "SELECT * FROM chalet ORDER BY num ASC";
		$result = mysqli_query($mysqli, $query);
		while ($row = mysqli_fetch_array($result)) {
			$trow = $row[0];
			if ($trow[0]==$temps[0] || strlen($trow)==strlen($temps)) {
				if (empty($row[1])) {
					$temp=$row[0];
					$time=date("m/d/Y");
					if ($checkin==$time){
						$sql ="CALL aupd('".$temp."', '".$lastname."', '".$firstname."', '".$checkin."', '".$contact."')";
						if ( $mysqli->query($sql) ){		
						}
					}else{
						$sql2 ="CALL ires('".$firstname."', '".$lastname."', '".$checkin."', '".$price."', '".$kol."', '".$contact."', '".$type."')";
						if ( $mysqli->query($sql2) ){
						}
					}
					$sql2 ="CALL ihis('"..$temp"' ,'".$firstname."', '".$lastname."', '".$checkin."', '".$price."', '".$kol."', '".$contact."')";
					if ( $mysqli->query($sql2) ){
						break;
					}
				}
			}	
		}
		if (empty($temp)) {
			header("location: ../alert.php");
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/receipt.css">
	<link href="../css/bootstrap.css" rel="stylesheet" />
	<title>Confirmation</title>
</head>
<body>
	<div class="box" style="background-color: rgba(40,40,40,1); color: white; margin-left: 5%;">
		<div id="indent">
			<h2><center>Confirmation</center></h2>
			<br><hr style="width: 80%;"><br>
			<p>Cottage Type: <?php echo $type;?> </p>
			<p>Check in: <?php echo $checkin; ?></p>
			<p>Name: <?php echo $firstname." ".$lastname; ?></p>
			<p>Contact: <?php echo $contact; ?></p>
			<p>Room Number: 
				<?php
				$time=date("m/d/Y");
				if ($checkin!=$time){
					echo "<br>You have an existing reservation, we cant give a room number yet.";
				}else{
					echo "$temp";
				} ?></p>
			<p>Price: <?php echo $price; ?> </p>
		</div>
	</div>
	<div class="complete" style="background-color: rgba(40,40,40,1); color: white; padding: 3%; border: 2px solid rgb(218, 165,32); margin-right: 2%;">
		<h1>Reservation Complete</h1>
		<hr>
		<p>Details about your reservation was sent via email. To complete this transaction pls go to our hotel within 24hours for validation</p>
		<br>
		<label>For more information you can contact us via </label><a href="">contact form</a>
		<br><br>
	</div>
	<div style="float: right; margin-top: 35%; margin-right: -25%;">
		<a class="btn btn-success" href="../index.php">Back to Homepage</a>
	</div>
</body>
</html>