<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM history";
$result = mysqli_query($mysqli, $query);

$temp= $_POST['picked'];
$status="0";

$sql="UPDATE history SET status = '$status' WHERE history_id='$temp'";

if ( $mysqli->query($sql) ){
	header("location: archived.php");
}else {
	echo "hays";
}
?>