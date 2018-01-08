<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'usep_cottage';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM cottage3";
$result = mysqli_query($mysqli, $query);

$none=NULL;
$temp=$_POST['picked'];
$status="0";

while ($row = mysqli_fetch_array($result)) {
	if ($temp===$row[0]) {
		$sql = "UPDATE cottage3 SET firstname='$none', lastname='$none' , checkin = '$none' , checkout = '$none' , contact='$none' , status = '$status' WHERE num='$temp'";
		if ( $mysqli->query($sql) ){
			header("location: chalet3.php");
		}else{
			echo "pagka";
		}
	}

}
?>