<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM reservation";
$result = mysqli_query($mysqli, $query);
$none=NULL;
$temp=$_POST['picked'];
$status="0";

while ($row = mysqli_fetch_array($result)) {
	if ($temp===$row[0]) {
		$sql = "DELETE FROM reservation WHERE reservation_id='$temp'";
		if ( $mysqli->query($sql) ){
			header("location: reservation.php");
		}
	}
}
?>