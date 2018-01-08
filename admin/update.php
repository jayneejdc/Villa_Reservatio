<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$type=$_POST['type'];
	$num=$_POST['num'];

	$query = "SELECT * FROM chalet";
	$result = mysqli_query($mysqli, $query);
	while ($row = mysqli_fetch_array($result)) {
		if ($num==$row[0]) {
			$query = "SELECT * FROM rooms";
			$result = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($result)) {
				if ($row[1]==$type) {
					$temp=$row[0];
					$sql="CALL upcha('".$temp."', '".$num."')";
					if ($mysqli->query($sql)){
		                header("Location: update_num.php");
		            }else{
		                echo "NO!";
		            }
				}
			}
		}
	}
}
?>
