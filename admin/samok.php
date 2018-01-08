<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM chalet";
$result = mysqli_query($mysqli, $query);

$none=NULL;
$temp=$_POST['picked'];
$status="0";

while ($row = mysqli_fetch_array($result)) {
	if ($temp===$row[0]) {
		$sql = "UPDATE chalet SET firstname='$none', lastname='$none' , checkin = '$none' ,contact='$none' WHERE num='$temp'";
		if ( $mysqli->query($sql) ){
			header("location: home.php");
		}else{
			echo "pagka";
		}
	}
}
?>